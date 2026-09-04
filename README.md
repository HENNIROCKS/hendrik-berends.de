# Made with Kirby and :heart:

This is the repository for my own personal website, [hendrik-berends.de](https://hendrik-berends.de). Built with Kirby CMS as a single monorepo — no plugin submodules, no separate theme repo.

**Please note**: this repository does not contain the `kirby/` or `vendor/` folders (installed via Composer) or `content/`/`media/` (live-only, never in Git).

## Setup

```bash
composer install
npm install
npm run build
cp .env.example .env  # add real values for MASTODON_INSTANCE/MASTODON_TOKEN/CONTENT_SALT/COOKIE_KEY
composer start
```

`composer start` runs Kirby's built-in dev server at `http://localhost:8000`.

## Structure

- `site/` — blueprints, collections, controllers, snippets, templates, config, plugins (Composer-managed).
- `src/` — build sources: `src/css/` (Tailwind v4: `styles.css` as the entry, plus `theme.css`, `base.css`, `components.css`), `src/scss/` (what is left of the legacy stylesheet: the design tokens and the lightbox import), `src/js/`.
- `assets/` — build output (`npm run build`), not hand-edited.

## Styling

Templates and snippets are styled with Tailwind v4 utilities (`npm run build:css:tailwind`), including Preflight. Markup that a component does not own — editor output, the imagex `picture`/`img` pair — is covered by the project's own `@utility` rules in `src/css/components.css`.

`src/scss/` still compiles alongside it (`npm run build:css:legacy`) and `head.php` loads both stylesheets. All that is left in it are the design tokens and the lightbox import; it holds no element rules any more. Its `:root` declarations are unlayered and therefore still win over the equally named tokens in `src/css/theme.css` — the one place the two differ today is `--color-salmon-700`. Both files disappear once the tokens move over for good.

## Deployment

Push to `main` triggers `.github/workflows/deploy.yml`: installs dependencies, builds assets, and deploys via FTP — gated behind the `DEPLOY_ENABLED` repository variable.

## Content sync

`content-sync.command` (double-click to run) pulls the live `content/` folder down from the ALL-INKL server via `lftp` — there's no SSH access on that host, so this is the fastest alternative to dragging files in an FTP client. It prompts for host, remote path (defaults to `live/homepage/content`) and credentials interactively; nothing is hardcoded in the script. Before syncing, it renames the existing local `content/` to `_content-YYMMDD` as a backup rather than overwriting it in place. Both the live `content/` folder and the dated backups are git-ignored and excluded from deployment, same as before.
