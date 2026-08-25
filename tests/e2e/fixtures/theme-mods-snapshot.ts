import { spawn } from 'child_process';
import path from 'path';
import fs from 'fs';

const OPTION_NAME = 'theme_mods_colormag';
const SNAPSHOT_PATH = path.join(__dirname, '..', '.auth', 'theme_mods_colormag.snapshot.b64');

type DbConfig = {
  host: string;
  port: string;
  user: string;
  password?: string;
  database: string;
  tablePrefix: string;
  mysqlBin: string;
};

function readDbConfig(): DbConfig {
  const host = process.env.WP_DB_HOST;
  const dbUser = process.env.WP_DB_USER;
  const database = process.env.WP_DB_NAME;

  if (!host || !dbUser || !database) {
    throw new Error(
      'WP_DB_HOST / WP_DB_USER / WP_DB_NAME are not set — cannot snapshot/restore ' +
        'theme_mods_colormag. See tests/e2e/.env.example.',
    );
  }

  return {
    host,
    port: process.env.WP_DB_PORT ?? '3306',
    user: dbUser,
    password: process.env.WP_DB_PASSWORD,
    database,
    tablePrefix: process.env.WP_DB_TABLE_PREFIX ?? 'wp_',
    mysqlBin: process.env.WP_DB_MYSQL_BIN ?? 'mysql',
  };
}

/**
 * Runs `sql` through the mysql client's stdin rather than a `-e "<sql>"`
 * argument. `theme_mods_colormag`'s serialized value is tens of KB, and a
 * `FROM_BASE64('<50KB+>')` UPDATE as a single command-line argument hits
 * Windows' argv length limit (`spawn ENAMETOOLONG`) — confirmed happening
 * on this suite's first run. Piping over stdin has no such limit.
 */
function runMysql(config: DbConfig, sql: string): Promise<string> {
  const args = ['-h', config.host, '-P', config.port, '-u', config.user, '-N', '-B'];
  if (config.password) args.push(`-p${config.password}`);
  args.push(config.database);

  return new Promise((resolve, reject) => {
    const child = spawn(config.mysqlBin, args, { stdio: ['pipe', 'pipe', 'pipe'] });
    let stdout = '';
    let stderr = '';
    child.stdout.on('data', (d) => (stdout += d));
    child.stderr.on('data', (d) => (stderr += d));
    child.on('error', reject);
    child.on('close', (code) => {
      if (stderr && !/using a password/i.test(stderr)) {
        console.warn(`theme-mods-snapshot: mysql reported: ${stderr.trim()}`);
      }
      if (code !== 0) {
        reject(new Error(`mysql exited with code ${code}: ${stderr.trim()}`));
        return;
      }
      resolve(stdout.trim());
    });
    child.stdin.end(sql);
  });
}

/**
 * Reads the live `theme_mods_colormag` option and writes it to a snapshot
 * file (base64, via MySQL's own TO_BASE64() — avoids any escaping issue
 * with control/multibyte characters inside the serialized value, which a
 * plain `mysql -B` text dump does NOT reliably preserve: confirmed corrupting
 * one byte during this suite's own development, see the QA report). Call
 * once, in global-setup, before the very first test runs.
 */
export async function snapshotThemeMods(): Promise<void> {
  const config = readDbConfig();
  const base64 = await runMysql(
    config,
    `SELECT TO_BASE64(option_value) FROM ${config.tablePrefix}options WHERE option_name='${OPTION_NAME}';`,
  );
  if (!base64) {
    throw new Error(`theme-mods-snapshot: '${OPTION_NAME}' not found in wp_options — nothing to snapshot.`);
  }
  fs.mkdirSync(path.dirname(SNAPSHOT_PATH), { recursive: true });
  fs.writeFileSync(SNAPSHOT_PATH, base64, 'utf8');
}

/**
 * Restores `theme_mods_colormag` from the snapshot taken by
 * snapshotThemeMods(). Uses MySQL's own FROM_BASE64() so the value never
 * passes through shell-quoting or SQL-string-escaping in this script at
 * all — the base64 text is the only thing interpolated into the SQL, and
 * base64's alphabet can't break out of a quoted SQL string.
 *
 * Called after EVERY test that uses the `customizer` fixture (see
 * customizer.ts), regardless of whether that test passed, failed, or
 * timed out — a customizer spec that fails partway through (e.g. after
 * publish() but before its own revert) otherwise leaves the live site
 * mutated for whatever spec runs next. Confirmed happening during this
 * suite's own development: an unrelated layout spec
 * (blog-layout/entry-summary-spacing.spec.ts) failed with a measured gap
 * more than 3x the expected size, purely because an earlier, unrelated
 * customizer spec had failed mid-test and left a typography change
 * published. This restore is the fix for that class of cross-test
 * contamination, not a per-spec revert.
 */
export async function restoreThemeMods(): Promise<void> {
  const config = readDbConfig();
  if (!fs.existsSync(SNAPSHOT_PATH)) {
    throw new Error(
      `theme-mods-snapshot: no snapshot at ${SNAPSHOT_PATH} — was snapshotThemeMods() called in global-setup?`,
    );
  }
  const base64 = fs.readFileSync(SNAPSHOT_PATH, 'utf8').trim();
  await runMysql(
    config,
    `UPDATE ${config.tablePrefix}options SET option_value = FROM_BASE64('${base64}') ` +
      `WHERE option_name='${OPTION_NAME}';`,
  );
}
