---
name: elegance
description: Build a beautiful, polished PHP + Bootstrap 5 website, or convert an existing static HTML site to PHP. Delivers a custom CSS-variable theme, shared includes (one navbar/head/footer instead of copies), data-driven cards from a single array, a working search page, a validated contact form, image optimization, SEO/Open Graph tags, and one-file Docker deploy. Use when the user wants to build, scaffold, or beautify a multi-page PHP + Bootstrap site, or to turn repetitive static HTML pages into maintainable PHP.
---

# Elegance — beautiful PHP + Bootstrap sites

Build a genuinely good-looking, multi-page PHP website using Bootstrap 5 and a
custom theme — then keep it that way as it grows. The pattern is intentionally
simple: plain PHP includes, no framework, no build step, deployable on any PHP host
or as a 3-line Docker image. It scales from a one-night concept site to a real
small-business site, and the design stays cohesive because the look lives in one
themeable place.

Elegance is as much about how it looks as how it's built: a considered palette and
type pairing, consistent spacing and cards, readable text over imagery, and a
polish pass before shipping — not just working PHP.

## Why PHP instead of plain HTML

Static HTML forces you to copy the navbar, `<head>`, and footer into every page;
change a phone number and you edit ten files. PHP fixes this with almost no extra
complexity — you still write mostly HTML, you just stop repeating yourself:

- **Shared includes** — write the navbar/head/footer once, `require` them everywhere.
- **Loops over data** — render a menu of 40 items from one array, not 40 copy-pasted blocks.
- **Real behavior** — a contact form that validates and emails, a search page that
  actually filters. Static HTML can't receive input at all.
- **Same hosting story** — drop the files on any PHP host, or deploy the included
  Docker image. No build step, no Node server to babysit.

This skill builds such a site from scratch **or converts an existing static HTML
site to PHP** (extract the repeated chrome into includes, turn duplicated card
markup into a data array + loop, wire up the form and search).

## When to use
- "Build me a website for my [bar / cafe / shop / studio]."
- "Scaffold a PHP + Bootstrap site."
- "Convert my HTML site to PHP" / "stop me repeating the navbar on every page."
- "Add a menu / search / contact page to my PHP site."
- "Make it deployable" / "host it on Render."

## Core conventions (do not skip)

1. **App lives in a subfolder.** Put the site in `app/` (or a brand-named folder),
   not the repo root. The repo root holds `Dockerfile`, `README.md`, `.gitignore`.
   Serve with `php -S localhost:8000` **from inside that folder**.
2. **Shared includes.** Every page is just:
   ```php
   <?php require_once('includes/head.php') ?>
   <?php require_once('includes/header.php') ?>
   <main> ... page content ... </main>
   <?php require_once('includes/footer.php') ?>
   ```
   The navbar, `<head>`, and footer are written once in `includes/`.
3. **Theme with CSS variables.** Define the palette and fonts once in `:root` in
   `css/style.css`. Never hardcode the same hex twice.
4. **Data-driven content.** Render cards/menu items by looping a PHP array, never
   by copy-pasting markup. If the same data feeds two pages (e.g. a menu page and
   a search page), put the array in `includes/menu-data.php` and `require` it from both.
5. **Web-safe asset names.** All images: lowercase, hyphenated, no spaces/accents
   (`the-jarls-mead.jpg`, not `The Jarl's Mead.png`). Rename on import.
6. **Optimize images.** Convert photo PNGs to JPEG, shrink oversized logos, and
   generate a favicon. Use `scripts/optimize-images.sh`. Update code references
   from `.png` to `.jpg` after converting.
7. **SEO + Open Graph.** `head.php` always carries `<meta name="description">`,
   Open Graph tags, and favicon links.
8. **Security on forms.** Validate every field server-side. Strip CR/LF from any
   value used in a `mail()` header (header-injection guard). Escape every echoed
   user value with `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`.

## Workflow

### Step 1 — Gather the brief
Ask for: brand name, what it is, vibe/palette (or infer), the pages needed, and
the content sections (e.g. a menu? a team? a gallery?). Don't over-ask — infer
sensible defaults and confirm.

### Step 2 — Scaffold from the template
Copy `assets/template/` into a new `app/` (or brand-named) folder. It contains a
working skeleton: `index.php`, `menu.php`, `gallery.php` (image grid + lightbox),
`about.php` (story, stats, values, map), `search.php`, `contact.php`, `includes/`,
`css/style.css`, and `Dockerfile`. Drop only the pages the brand needs. Replace `{{BRAND}}`,
`{{TAGLINE}}`, palette variables, and nav links.

See `references/structure-and-conventions.md` for the full file map and the exact
patterns (the include chain, the card loop, the search matcher, the mail guard).

### Step 3 — Theme it
Pick a starting look from `references/style-presets.md` (Mead Hall, Editorial,
Minimal, Aurora) — or derive a fresh one from the brand's vibe. A theme is just the
`:root` variables (one accent + neutrals) plus two Google Fonts: one display, one
body. Swap those and the whole mood changes. Keep contrast high enough for the
chosen background.

### Step 4 — Fill content
Put real items in the PHP data array(s). Add real copy. For voice, write concrete
and specific, not generic-marketing (see the README guidance in the reference).

### Step 5 — Add & optimize images
Drop images in `assets/`, rename to slugs, then run:
```bash
bash scripts/optimize-images.sh app/assets
```
It converts photo PNGs → JPEG, shrinks the logo, and makes `favicon.png` +
`apple-touch-icon.png`. Then update any `.png` references to `.jpg`.

### Step 6 — Verify
- `php -l` every `.php` file (no syntax errors).
- `php -S localhost:8000` from the app folder; curl each page for HTTP 200.
- Confirm every referenced image resolves (0 missing) and no orphans.

### Step 7 — Deploy
The included `Dockerfile` (`php:8.2-apache` copying the app subfolder) deploys on
Render / Railway / Fly. Push to GitHub, create a Web Service, it auto-builds. Add
the live URL to the README and as the repo homepage. Note that `mail()` needs an
SMTP service configured on the host to actually send.

## Design principles (the elegance part)

Working PHP isn't the goal — a site that looks considered is. Before shipping:

- **One type pairing:** a display face for headings, a readable face for body. No more.
- **One accent color**, used consistently (buttons, links, key numbers). Everything
  else is neutrals from the palette variables.
- **Generous, consistent spacing.** Let sections breathe; align to a grid; don't crowd.
- **Readable text over images:** always layer a gradient/overlay so copy stays legible.
- **Consistent cards:** same radius, border, and image aspect ratio across the site.
- **Restraint:** one strong hero, clear hierarchy, few weights. Cohesion reads as quality.
- **Responsive + fast:** check mobile; optimize images; no layout shift.

If a design feels generic or busy, that's a signal — simplify, align, and commit to
the palette before adding anything new.

## Converting an existing static HTML site

When the user already has `.html` pages, don't rebuild from scratch — refactor:

1. **Lift the repeated chrome.** Find the identical `<head>`, navbar, and footer
   copied across pages. Cut each into `includes/head.php`, `includes/header.php`,
   `includes/footer.php`.
2. **Rename `page.html` → `page.php`** and replace the cut chrome with the three
   `require_once` lines.
3. **De-duplicate markup into data.** Any block repeated with only the content
   changing (cards, products, list rows) becomes one PHP array + a `foreach` loop.
   If two pages need it, move the array to `includes/<name>-data.php`.
4. **Make dead things work.** A search box with no `action`, or a form that posts
   nowhere, gets replaced by the working `search.php` / `contact.php` patterns.
5. **Finish:** add meta/OG tags, optimize images, add the `Dockerfile`, verify.

## Reference files
- `references/structure-and-conventions.md` — full file map, code patterns, deploy notes.
- `references/style-presets.md` — ready-made themes (Mead Hall, Editorial, Minimal, Aurora).
- `assets/template/` — copy-ready starter site.
- `scripts/optimize-images.sh` — the image pipeline.
