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

===

<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.4
- laravel/fortify (FORTIFY) - v1
- laravel/framework (LARAVEL) - v13
- laravel/mcp (MCP) - v0
- laravel/prompts (PROMPTS) - v0
- livewire/flux (FLUXUI_FREE) - v2
- livewire/livewire (LIVEWIRE) - v4
- laravel/boost (BOOST) - v2
- laravel/pail (PAIL) - v1
- laravel/pint (PINT) - v1
- laravel/sail (SAIL) - v1
- pestphp/pest (PEST) - v4
- phpunit/phpunit (PHPUNIT) - v12
- tailwindcss (TAILWINDCSS) - v4

## Skills Activation

This project has domain-specific skills available. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

- `laravel-best-practices` — Apply this skill whenever writing, reviewing, or refactoring Laravel PHP code. This includes creating or modifying controllers, models, migrations, form requests, policies, jobs, scheduled commands, service classes, and Eloquent queries. Triggers for N+1 and query performance issues, caching strategies, authorization and security patterns, validation, error handling, queue and job configuration, route definitions, and architectural decisions. Also use for Laravel code reviews and refactoring existing Laravel code to follow best practices. Covers any task involving Laravel backend PHP code patterns.
- `mcp-development` — Use this skill for Laravel MCP development only. Trigger when creating or editing MCP tools, resources, prompts, or servers in Laravel projects. Covers: artisan make:mcp-* generators, mcp:inspector, routes/ai.php, Tool/Resource/Prompt classes, schema validation, shouldRegister(), OAuth setup, URI templates, read-only attributes, and MCP debugging. Do not use for non-Laravel MCP projects or generic AI features without MCP.
- `fluxui-development` — Use this skill for Flux UI development in Livewire applications only. Trigger when working with <flux:*> components, building or customizing Livewire component UIs, creating forms, modals, tables, or other interactive elements. Covers: flux: components (buttons, inputs, modals, forms, tables, date-pickers, kanban, badges, tooltips, etc.), component composition, Tailwind CSS styling, Heroicons/Lucide icon integration, validation patterns, responsive design, and theming. Do not use for non-Livewire frameworks or non-component styling.
- `livewire-development` — Use for any task or question involving Livewire. Activate if user mentions Livewire, wire: directives, or Livewire-specific concepts like wire:model, wire:click, wire:sort, or islands, invoke this skill. Covers building new components, debugging reactivity issues, real-time form validation, drag-and-drop, loading states, migrating from Livewire 3 to 4, converting component formats (SFC/MFC/class-based), and performance optimization. Do not use for non-Livewire reactive UI (React, Vue, Alpine-only, Inertia.js) or standard Laravel forms without Livewire.
- `pest-testing` — Use this skill for Pest PHP testing in Laravel projects only. Trigger whenever any test is being written, edited, fixed, or refactored — including fixing tests that broke after a code change, adding assertions, converting PHPUnit to Pest, adding datasets, and TDD workflows. Always activate when the user asks how to write something in Pest, mentions test files or directories (tests/Feature, tests/Unit, tests/Browser), or needs browser testing, smoke testing multiple pages for JS errors, or architecture tests. Covers: it()/expect() syntax, datasets, mocking, browser testing (visit/click/fill), smoke testing, arch(), Livewire component tests, RefreshDatabase, and all Pest 4 features. Do not use for factories, seeders, migrations, controllers, models, or non-test PHP code.
- `tailwindcss-development` — Always invoke when the user's message includes 'tailwind' in any form. Also invoke for: building responsive grid layouts (multi-column card grids, product grids), flex/grid page structures (dashboards with sidebars, fixed topbars, mobile-toggle navs), styling UI components (cards, tables, navbars, pricing sections, forms, inputs, badges), adding dark mode variants, fixing spacing or typography, and Tailwind v3/v4 work. The core use case: writing or fixing Tailwind utility classes in HTML templates (Blade, JSX, Vue). Skip for backend PHP logic, database queries, API routes, JavaScript with no HTML/CSS component, CSS file audits, build tool configuration, and vanilla CSS.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Always use `search-docs` before making code changes. Do not skip this step. It returns version-specific docs based on installed packages automatically.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.
- To check environment variables, read the `.env` file directly.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== herd rules ===

# Laravel Herd

- The application is served by Laravel Herd at `https?://[kebab-case-project-dir].test`. Use the `get-absolute-url` tool to generate valid URLs. Never run commands to serve the site. It is always available.
- Use the `herd` CLI to manage services, PHP versions, and sites (e.g. `herd sites`, `herd services:start <service>`, `herd php:list`). Run `herd list` to discover all available commands.

=== tests rules ===

# Test Enforcement

- Every change must be programmatically tested. Write a new test or update an existing test, then run the affected tests to make sure they pass.
- Run the minimum number of tests needed to ensure code quality and speed. Use `php artisan test --compact` with a specific filename or filter.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

=== livewire/core rules ===

# Livewire

- Livewire allow to build dynamic, reactive interfaces in PHP without writing JavaScript.
- You can use Alpine.js for client-side interactions instead of JavaScript frameworks.
- Keep state server-side so the UI reflects it. Validate and authorize in actions as you would in HTTP requests.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

## Pest

- This project uses Pest for testing. Create tests: `php artisan make:test --pest {name}`.
- Run tests: `php artisan test --compact` or filter: `php artisan test --compact --filter=testName`.
- Do NOT delete tests without approval.

</laravel-boost-guidelines>
