import { test, expect } from '../../fixtures/wp-admin';

/**
 * Guards an invariant from the knowledge file's roles table (CONVENTIONS.md
 * rule 7): a Subscriber must never reach the Customizer. A regression here
 * is a security issue, not a UX one, which is why it gets a named test
 * rather than living in a checklist.
 *
 * WP-CLI is not available in this environment (see .themegrill-qa/knowledge.md,
 * Environment notes — the global `wp` install here is broken), so the test
 * user is created and torn down through the REST API instead of the
 * `createUser`/wp-cli pattern CONVENTIONS.md describes for other products
 * in this catalogue. The nonce is read from `wpApiSettings`, which the
 * block editor always localizes, rather than assuming any particular admin
 * screen exposes it.
 *
 * Verified live on this site (2026-08-25): a real Subscriber account
 * (created and deleted by this same flow, manually, outside this spec)
 * got a 403 from /wp-admin/customize.php. No bug found — documenting the
 * correct behavior so a regression here fails loudly.
 */
test('subscriber cannot reach the customizer @pr', async ({ page, request }) => {
  test.setTimeout(60_000);
  await page.goto('/wp-admin/post-new.php?post_type=post');
  const nonce = await page.evaluate(() => (window as any).wpApiSettings?.nonce);
  expect(nonce, 'Could not read a REST nonce from wpApiSettings — is the block editor still enqueuing it?').toBeTruthy();

  const username = `qa-subscriber-${Date.now()}`;
  const password = `Qa!${Math.random().toString(36).slice(2)}Aa1`;

  const createRes = await request.post('/wp-json/wp/v2/users', {
    headers: { 'X-WP-Nonce': nonce },
    data: {
      username,
      email: `${username}@example.test`,
      password,
      roles: ['subscriber'],
    },
  });
  expect(createRes.ok(), `Failed to create test subscriber: ${await createRes.text()}`).toBeTruthy();
  const created = await createRes.json();

  try {
    // Log in as the subscriber in a fresh, unauthenticated context so the
    // admin storageState session isn't disturbed for the rest of the run.
    const subscriberContext = await page.context().browser()!.newContext();
    const subscriberPage = await subscriberContext.newPage();
    try {
      await subscriberPage.goto('/wp-login.php');
      await subscriberPage.locator('#user_login').fill(username);
      await subscriberPage.locator('#user_pass').fill(password);
      await subscriberPage.locator('#wp-submit').click();
      await subscriberPage.locator('#wpadminbar').waitFor({ state: 'visible', timeout: 30_000 });

      const response = await subscriberPage.goto('/wp-admin/customize.php');
      expect(response?.status(), 'Subscriber should be denied the Customizer').toBe(403);
    } finally {
      await subscriberContext.close();
    }
  } finally {
    await request.delete(`/wp-json/wp/v2/users/${created.id}`, {
      headers: { 'X-WP-Nonce': nonce },
      data: { reassign: 1, force: true },
    });
  }
});
