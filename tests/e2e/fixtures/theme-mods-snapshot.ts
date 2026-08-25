import { spawn } from 'child_process';
import path from 'path';
import fs from 'fs';
import { hasMysql, targetEnv } from '../env';

const SNAPSHOT_PATH = path.join(__dirname, '..', '.auth', 'theme-mods-baseline.json');

export type DbConfig = {
  host?: string;
  port: string;
  socket?: string;
  user: string;
  password?: string;
  database: string;
  tablePrefix: string;
  mysqlBin: string;
};

export function readDbConfig(): DbConfig {
  const host = process.env.WP_DB_HOST;
  const socket = process.env.WP_DB_SOCKET;
  const dbUser = process.env.WP_DB_USER;
  const database = process.env.WP_DB_NAME;

  if ((!host && !socket) || !dbUser || !database) {
    throw new Error(
      'Database connection is not configured: set WP_DB_USER, WP_DB_NAME and either ' +
        'WP_DB_HOST or WP_DB_SOCKET in .env.local at the theme root. See tests/e2e/.env.example.',
    );
  }

  return {
    host,
    port: process.env.WP_DB_PORT ?? '3306',
    socket,
    user: dbUser,
    password: process.env.WP_DB_PASSWORD,
    database,
    tablePrefix: process.env.WP_DB_TABLE_PREFIX ?? 'wp_',
    mysqlBin: process.env.WP_DB_MYSQL_BIN ?? 'mysql',
  };
}

/**
 * Connection flags for the `mysql` client.
 *
 * A unix socket wins over host/port when both are set. Local by Flywheel on
 * macOS is the case that forces this: its MySQL listens on a port but refuses
 * `127.0.0.1` with "Host is not allowed to connect to this MySQL server",
 * while accepting the same credentials over its socket. `WP_DB_HOST` in
 * wp-config carries the socket in PHP's `localhost:/path/to.sock` form, which
 * the CLI does not understand — hence a separate variable rather than parsing
 * one that means different things to different clients.
 */
export function connectionArgs(config: DbConfig): string[] {
  if (config.socket) return ['--socket', config.socket];
  return ['-h', config.host as string, '-P', config.port];
}

/**
 * Runs `sql` through the mysql client's stdin rather than a `-e "<sql>"`
 * argument. A theme's serialized mods value is tens of KB, and a
 * `FROM_BASE64('<50KB+>')` UPDATE as a single command-line argument hits
 * Windows' argv length limit (`spawn ENAMETOOLONG`) — confirmed happening
 * on this suite's first run. Piping over stdin has no such limit.
 */
function runMysql(config: DbConfig, sql: string): Promise<string> {
  const args = [...connectionArgs(config), '-u', config.user, '-N', '-B'];
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

let cachedOptionName: string | null = null;

/**
 * The theme-mods option belonging to whatever theme is *actually active*.
 *
 * This used to be the constant `theme_mods_colormag`, which was wrong in a way
 * that produced no error and no failing test: WordPress stores mods per
 * stylesheet, so on a site running ColorMag Pro (a standalone theme, not a
 * child) the Customizer writes `theme_mods_colormag-pro` while the restore
 * dutifully rewrote `theme_mods_colormag` — an option nothing under test had
 * touched. The safety net reported success on every teardown while restoring
 * nothing, which is strictly worse than having no safety net, because it was
 * believed. Confirmed on test-colormag.local, where both options exist side
 * by side.
 *
 * Resolved once per process and cached; a run cannot switch themes mid-flight.
 */
async function themeModsOption(config: DbConfig): Promise<string> {
  if (cachedOptionName) return cachedOptionName;

  const stylesheet = await runMysql(
    config,
    `SELECT option_value FROM ${config.tablePrefix}options WHERE option_name='stylesheet';`,
  );
  if (!stylesheet) {
    throw new Error(
      "theme-mods-snapshot: could not read the 'stylesheet' option — is this the right database?",
    );
  }

  cachedOptionName = `theme_mods_${stylesheet}`;
  return cachedOptionName;
}

/**
 * Reads the active theme's mods and writes them to a snapshot file (base64,
 * via MySQL's own TO_BASE64() — avoids any escaping issue with control or
 * multibyte characters inside the serialized value, which a plain `mysql -B`
 * text dump does NOT reliably preserve: confirmed corrupting one byte during
 * this suite's own development). Call once, in global-setup, before the first
 * test runs.
 *
 * A no-op off `local`. On Playground the site is disposable and rebuilt from a
 * blueprint per run, so there is nothing to protect and — more to the point —
 * no MySQL to protect it with.
 */
export async function snapshotThemeMods(): Promise<void> {
  if (!hasMysql()) {
    console.warn(
      `theme-mods-snapshot: skipping snapshot on '${targetEnv()}' — disposable site, no MySQL.`,
    );
    return;
  }

  const config = readDbConfig();
  const option = await themeModsOption(config);
  const base64 = await runMysql(
    config,
    `SELECT TO_BASE64(option_value) FROM ${config.tablePrefix}options WHERE option_name='${option}';`,
  );
  if (!base64) {
    throw new Error(
      `theme-mods-snapshot: '${option}' not found in ${config.tablePrefix}options — nothing to snapshot. ` +
        'That means the active theme has never had a customizer setting saved; open the Customizer ' +
        'and publish once, then re-run.',
    );
  }
  fs.mkdirSync(path.dirname(SNAPSHOT_PATH), { recursive: true });
  fs.writeFileSync(SNAPSHOT_PATH, base64, 'utf8');
  console.warn(`theme-mods-snapshot: baseline captured for '${option}'.`);
}

/**
 * Restores the active theme's mods from the snapshot above. Uses MySQL's own
 * FROM_BASE64() so the value never passes through shell-quoting or SQL-string
 * escaping in this script at all — the base64 text is the only thing
 * interpolated into the SQL, and base64's alphabet cannot break out of a
 * quoted SQL string.
 *
 * Called after EVERY test that uses the `customizer` fixture, regardless of
 * whether that test passed, failed, or timed out — a customizer spec that
 * fails partway through (e.g. after publish() but before its own revert)
 * otherwise leaves the live site mutated for whatever spec runs next.
 * Confirmed happening during this suite's development: an unrelated layout
 * spec failed with a measured gap more than 3x the expected size, purely
 * because an earlier customizer spec had failed mid-test and left a
 * typography change published.
 *
 * **Never throws.** A restore that throws inside a fixture teardown replaces
 * the test's real failure with its own, hiding the thing you were trying to
 * debug behind a plumbing error. A missing snapshot in particular is now a
 * warning, not an error: on Playground there is deliberately no snapshot, and
 * on a run whose global-setup was skipped there is no baseline to be faithful
 * to. Both are states to report and continue from.
 */
export async function restoreThemeMods(): Promise<void> {
  if (!hasMysql()) return;

  if (!fs.existsSync(SNAPSHOT_PATH)) {
    console.warn(
      `theme-mods-snapshot: no baseline at ${SNAPSHOT_PATH} — nothing to restore. ` +
        'Any customizer change this run published is still live on the site.',
    );
    return;
  }

  try {
    const config = readDbConfig();
    const option = await themeModsOption(config);
    const base64 = fs.readFileSync(SNAPSHOT_PATH, 'utf8').trim();
    await runMysql(
      config,
      `UPDATE ${config.tablePrefix}options SET option_value = FROM_BASE64('${base64}') ` +
        `WHERE option_name='${option}';`,
    );
  } catch (err) {
    console.warn(
      `theme-mods-snapshot: restore failed (${(err as Error).message}). ` +
        'The site may still carry a change this run published — restore it by hand before trusting the next run.',
    );
  }
}

/** Where the baseline lives, for global-setup/teardown to report on. */
export { SNAPSHOT_PATH };
