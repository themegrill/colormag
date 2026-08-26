import { restoreThemeMods, SNAPSHOT_PATH } from './fixtures/theme-mods-snapshot';
import { hasMysql, targetEnv } from './env';

/**
 * Put the site back, once, however the run ended.
 *
 * The `customizer` fixture already restores after each test that used it, and
 * that per-test restore is the one that prevents cross-test contamination.
 * This is the outer belt: it runs after a `--grep` that matched no customizer
 * spec, after a run killed by `--max-failures`, and after a crash in a spec
 * that published without ever reaching the fixture teardown. Section 2.3 of
 * the harness contract asks for exactly this — an unconditional restore that
 * survives the snapshot file being absent.
 *
 * `restoreThemeMods()` never throws (see its docblock), so a teardown problem
 * is reported rather than turned into a run-level failure that would mask
 * whatever the tests actually found.
 */
export default async function globalTeardown() {
  if (!hasMysql()) return;

  await restoreThemeMods();
  console.warn(
    `colormag e2e: theme mods restored from ${SNAPSHOT_PATH} (env: ${targetEnv()}).`,
  );
}
