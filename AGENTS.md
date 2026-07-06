# Agents Guide - Desa Tatung

## Core Stack
- Laravel 13 / PHP ^8.3 (CI tests 8.3, 8.4, 8.5 — avoid syntax exclusive to 8.4+)
- Livewire 4 / Flux UI 2 (paid package — credentials required)
- Tailwind CSS 4 (no `tailwind.config.js` — configured via `@tailwindcss/vite` plugin only)
- SQLite (default DB, `:memory:` in tests)
- Pest 4 / PHPUnit 12

## Developer Commands

| Command | What it does |
|---|---|
| `composer setup` | Full init: install → `.env` → `key:generate` → `migrate` → `npm install` → `npm run build` |
| `composer dev` | Concurrent: `artisan serve` + `queue:listen --tries=1` + `vite` |
| `composer lint` | `pint --parallel` — fixes PHP style in-place |
| `composer lint:check` | `pint --parallel --test` — dry-run, non-zero exit if fixes needed |
| `composer test` | `config:clear` → `lint:check` → `php artisan test` |
| `npm run dev` | Vite HMR dev server |
| `npm run build` | Production Vite build → `public/build/` |

## Verification Workflow (in order)
1. Edit PHP files → run `vendor/bin/pint --dirty --format agent` (fixes in-place, agent-friendly output)
2. `php artisan test --compact` — runs lint:check + full test suite
3. Frontend changes → `npm run build` to verify no Vite errors

## Running Tests
```bash
php artisan test --compact                                        # all tests
php artisan test --compact --filter=testName                     # single test by name
php artisan test --compact tests/Feature/Admin/BeritaCRUDTest.php # single file
./vendor/bin/pest                                                 # direct (used in CI)
```
- `RefreshDatabase` is applied globally to **all** Feature tests via `tests/Pest.php` — do not add it per-file.
- SQLite `:memory:`, `QUEUE_CONNECTION=sync`, `CACHE_STORE=array` in test env (`phpunit.xml`).
- **Do not delete tests without explicit approval.**

## Flux UI — Credentials Required
Flux UI is a paid package. Before `composer install` on a new machine:
```bash
composer config http-basic.composer.fluxui.dev "USERNAME" "LICENSE_KEY"
```
GitHub Actions uses `FLUX_USERNAME` / `FLUX_LICENSE_KEY` secrets.

## Authentication — NIK-Based (Not Email)
- **Email was dropped** from the `users` table (`drop_email_from_users_table` migration).
- Users log in with **NIK** (16-digit national ID number), not email.
- `password_reset_tokens` uses `nik` as primary key.
- User fields: `name`, `nik` (unique, 16 chars), `no_hp` (nullable), `password`.
- Fortify customized in `app/Actions/Fortify/` and `app/Providers/FortifyServiceProvider.php`.

## Roles (spatie/laravel-permission)
Three roles exist: `Super Admin`, `Admin Kependudukan`, `Warga`.
- Admin routes: `auth + verified + role:Super Admin|Admin Kependudukan` middleware
- Warga routes: `auth + verified + role:Warga` middleware
- No custom middleware — role enforcement is entirely via Spatie's route middleware.

## Routing Pattern
- Public: `Route::name('publik.')` prefix group
- Admin: `/admin` prefix, `admin.` name prefix
- Warga: `/warga` prefix, `warga.` name prefix
- Settings: `routes/settings.php` (included via `require`)
- Full-page Livewire/Volt components registered with `Route::livewire()` using `pages::` prefix:
  ```php
  Route::livewire('/dashboard', 'pages::admin.dashboard')->name('dashboard');
  ```

## Frontend Architecture
- **Two CSS bundles:** `resources/css/app.css` (app shell) and `resources/css/portal.css` (admin/portal styles) — both compiled by Vite.
- Three layouts: `layouts/app.blade.php` (auth app), `layouts/auth.blade.php` (auth pages), `layouts/public.blade.php` (public site).
- Flux UI component overrides live in `resources/views/flux/`.

## Domain-Specific Notes
- **`penduduk` model** has a lowercase class name (`class penduduk extends Model`) — naming quirk, do not "fix" without knowing impact.
- **Excel import** (`maatwebsite/excel`): `app/Imports/PendudukImport.php` upserts on `nik`; date format `d-m-Y` → `Y-m-d` via Carbon. Import endpoint: `admin.penduduk.import` (POST, only non-Livewire admin route).
- **NavigationService**: `app/Services/NavigationService.php` returns public nav as PHP array with `label`, `route`, `active_pattern`, `subitems` keys. Supports `'is_divider' => true` for dropdown dividers.
- **`app/Enums/` is empty** — no enums exist yet; use TitleCase when adding.
- **`laravel/boost`** (dev dep) is an MCP server — use its `database-query`, `database-schema`, `browser-logs`, `search-docs` tools before writing code.

## PHP Style Conventions (enforced by Pint + CLAUDE.md)
- Constructor property promotion required.
- Explicit return types and type hints on all methods.
- `#[Fillable(...)]` / `#[Hidden(...)]` PHP 8 attributes on User model (not `$fillable`/`$hidden` array properties).
- PHPDoc blocks preferred over inline comments; use array shape type definitions.
- Always use curly braces for control structures.

## Reference Documents
- `CLAUDE.md` — detailed Laravel Boost usage, full coding conventions, and framework-wide guidelines.
