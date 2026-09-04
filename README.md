## Useful Commands
### Gulp
* gulp sassCompile: compile SCSS files to style.css file.
* gulp styles: compile SCSS and regenerate the RTL stylesheets. Run this after any SCSS change.
* gulp watch: watch changes to SCSS files and compile theme to respective css files on changes.

### Start Development
* git clone git@github.com:themegrill/colormag.git
* pnpm install
* for CSS work: gulp watch

## Releasing

Releases are cut by the **Draft Release** workflow
(`.github/workflows/release.yml`). It only ever produces a *draft* — a human
publishes it, and publishing is what makes the release real.

### What triggers it

A push to `master` whose head commit message contains **`version bump to release of`**,
or a manual **Run workflow** on `master`.

The branch guard applies to manual runs too, so a manual run from a non-`master`
ref does nothing. That is deliberate: without it, a dispatch could tag a commit
that was never on `master`.

### 1. Prepare the branch

Work lands on the release branch (`release/x.y.z`), gets reviewed, then merges to
`master`. Everything below happens on the release branch before that merge.

### 2. Bump the version

The version is authored in **`assets/sass/style.scss`** — `style.css` is compiled
output, so editing it directly is undone by the next build.

1. `assets/sass/style.scss` → `Version: x.y.z`
2. `readme.txt` → both `Version:` and `Stable tag:`
3. Recompile so the generated files carry the new header:

   ```bash
   npx gulp styles
   ```

   That regenerates `style.css` and `style-rtl.css`.

Confirm the version the workflow will actually read:

```bash
grep -m1 -E '^[[:space:]]*Version:' style.css
```

The tag becomes `v` + that value, e.g. `4.2.3` → `v4.2.3`.

### 3. Finish the changelog

In `changelog.txt`, replace the placeholder date on the heading for this version:

```
= Version 4.2.3 - 2026-09-03 =
```

The workflow extracts the block for **this exact version** and fails the release
if it finds none, rather than shipping the previous version's notes under a new
tag. It matches `= Version <x.y.z> ` including the trailing space, so keep the
heading in that shape.

Entries are one line each, in the file's existing `Added` / `Tweak` / `Fix`
vocabulary and column alignment. A fix to something that never shipped in a
released version does not need an entry — users never saw the broken state.

### 4. Merge to master

Commit the bump with a message containing the trigger phrase, matching the
existing history:

```
Final version bump to release of v4.2.3
```

Merge to `master`. The workflow starts on the resulting push.

### 5. What the workflow does

1. Reads the version from `style.css`, derives the tag
2. Skips entirely if a release with that tag already exists — so a retry after a
   partial failure is safe
3. Extracts this version's changelog block into the release notes
4. Installs pnpm + Composer deps, runs `composer makepot`, `pnpm build`, `pnpm exec gulp build`
5. Verifies `dist/colormag.zip` and `languages/colormag.pot` exist, and that the
   `.pot` is actually inside the zip
6. Creates and pushes the tag (skipped if it already exists)
7. Creates a **draft** GitHub Release with the zip attached

### 6. Publish

Review the draft release — notes and attached zip — then publish it.

### 7. WordPress.org

Publishing the release (step 6) triggers **Deploy to WordPress.org**
(`.github/workflows/svn-deploy.yml`) automatically — there is no separate
manual upload step. `Stable tag:` in `readme.txt` must match the released
version, since that's what .org uses to decide which build to serve.

It downloads the *exact* zip attached to the release (never rebuilds), checks
the zip's `style.css` version against the release tag, sanity-checks the
build (required files present, file count not suspiciously low), then commits
it to `themes.svn.wordpress.org/colormag`. Unlike a plugin, a theme SVN repo
has no `trunk`/`tags`/`assets` — it's a flat list of version directories
(`4.2.1/`, `4.2.2/`, ...), each an immutable snapshot. Releasing just adds a
new sibling directory named after the version; there's nothing to sync or
delete, and no way for this to touch a previously published version. A
version that already exists in SVN is skipped, so re-running after a failure
is safe.

**One-time setup, before this can run for real:**

1. Repo secrets `SVN_USERNAME` and `SVN_KEY` (the .org account's SVN password)
   — already configured.
2. Settings → Environments → create `wordpress-org-svn` and add a required
   reviewer. The job is pointed at this environment, so nothing runs — not
   even a dry run — until someone approves it in the Actions tab. Without a
   reviewer configured, the environment has no protection and the job runs
   immediately.

**Testing without touching the live repo:** run the workflow manually
(Actions → Deploy to WordPress.org → Run workflow) with a real tag and
`dry_run` left at its default `true`. Everything runs — download, SVN
checkout, sanity checks, staging the new version directory locally — except
the final `svn commit`, so you can verify the whole pipeline against a real
release with zero risk.

### If it fails

- **"Could not parse a Version from style.css"** — the build did not run, or ran
  before the `style.scss` bump. Re-run `npx gulp styles` and check the header.
- **"changelog.txt has no '= Version x.y.z ' block"** — the heading is missing,
  misspelled, or still carries the `xxxx-xx-xx` placeholder in a way that broke
  the prefix match.
- **Tag exists but no release** — re-run the workflow; the tag push is skipped
  and the release is created on top of it.
- **"Release tag says X but the zipped style.css says Y"** (svn-deploy) — the
  release was built from a commit whose `style.css` didn't match its own tag.
  Re-cut the release rather than forcing this through.
- **"Build only has N files"** (svn-deploy) — the zip looks incomplete or
  wrong. Check the release's attached zip before re-running.
- **`svn: command not found`** — shouldn't happen; the workflow installs it.
  If it recurs, the runner image changed again — check `Install Subversion`.
