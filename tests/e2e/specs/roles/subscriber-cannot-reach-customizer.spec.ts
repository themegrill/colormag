import { test, expect } from '../../fixtures/wp-admin';
import { baseUrl } from '../../env';

/**
 * @area    additional
 * @tier    fresh
 * @source  human 2026-08-25
 * @why     A Subscriber reaching the Customizer is a privilege-escalation
 *          bug, not a UX one — it would let any registered user rewrite the
 *          site's appearance. Declared as an invariant in the knowledge
 *          file's roles table, so CONVENTIONS.md rule 7 asks for a named test
 *          enforcing it rather than a checklist line.
 *
 * Creates and tears down its own Subscriber through the REST API, so it needs
 * no pre-existing test user and leaves none behind — which is what makes it
 * `@fresh` on a disposable site. The nonce is read from `wpApiSettings`, which
 * the block editor always localizes, rather than assuming any particular admin
 * screen exposes it.
 *
 * Verified live on this site (2026-08-25): a real Subscriber account
 * (created and deleted by this same flow, manually, outside this spec)
 * got a 403 from /wp-admin/customize.php. No bug found — documenting the
 * correct behavior so a regression here fails loudly.
 */
test('subscriber cannot reach the customizer @fresh @additional', async ({ page, request }) => {
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
    // baseURL must be passed explicitly: a context created straight off the
    // browser does NOT inherit the config's `use.baseURL`, so every relative
    // goto below would throw "Invalid URL". This spec had never actually run
    // — the bug was latent behind a global-setup that failed earlier.
    const subscriberContext = await page.context().browser()!.newContext({ baseURL: baseUrl() });
    const subscriberPage = await subscriberContext.newPage();
    try {
      await subscriberPage.goto('/wp-login.php');
      await subscriberPage.locator('#user_login').fill(username);
      await subscriberPage.locator('#user_pass').fill(password);
      await subscriberPage.locator('#wp-submit').click();
      await subscriberPage.waitForURL((u) => !u.pathname.endsWith('/wp-login.php'), { timeout: 30_000 });

      // Confirm the session from the auth cookie WordPress sets, rather than
      // by waiting for #wpadminbar. The admin bar is NOT a reliable logged-in
      // signal for a low-privilege role: WooCommerce hides it from customers
      // and redirects them to the front-end My Account page, so the original
      // wait timed out on a login that had in fact succeeded — a false failure
      // that says nothing about the capability under test.
      //
      // A REST probe is no good here either: cookie auth alone is not enough
      // for the REST API, which answers 401 without an X-WP-Nonce header, so
      // that check would fail for a perfectly valid session too.
      const cookies = await subscriberContext.cookies();
      expect(
        cookies.some((c) => c.name.startsWith('wordpress_logged_in_')),
        `Subscriber "${username}" did not end up logged in — no wordpress_logged_in_ cookie was set.`,
      ).toBeTruthy();

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
