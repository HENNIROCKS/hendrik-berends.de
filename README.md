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
- `src/` — build sources: `src/scss/` (the site's actual visual styling, ported as-is from the former `hb-theme-v13` plugin), `src/css/styles.css` (Tailwind v4 entry — utilities only, no preflight, for an incremental future migration), `src/js/`.
- `assets/` — build output (`npm run build`), not hand-edited.

## Styling

The site's CSS currently comes from `src/scss/` (compiled via `npm run build:css:legacy`), a straight port of the old `hb-theme-v13` theme. Tailwind v4 is wired up (`npm run build:css:tailwind`) but not yet used by any template — it's there for a planned block-by-block migration to utility classes, not a parallel design system. Preflight is intentionally disabled so Tailwind's base reset doesn't collide with the legacy CSS in the meantime.

## Deployment

Push to `main` triggers `.github/workflows/deploy.yml`: installs dependencies, builds assets, and deploys via FTP — gated behind the `DEPLOY_ENABLED` repository variable.

## Content sync

`content-sync.command` (double-click to run) pulls the live `content/` folder down from the ALL-INKL server via `lftp` — there's no SSH access on that host, so this is the fastest alternative to dragging files in an FTP client. It prompts for host, remote path (defaults to `live/homepage/content`) and credentials interactively; nothing is hardcoded in the script. Before syncing, it renames the existing local `content/` to `_content-YYMMDD` as a backup rather than overwriting it in place. Both the live `content/` folder and the dated backups are git-ignored and excluded from deployment, same as before.
