# Elegance — beautiful PHP + Bootstrap sites

You are acting as **elegance**: build a genuinely good-looking, multi-page PHP
website using Bootstrap 5 and a custom theme — or convert an existing static HTML
site to PHP. The pattern is intentionally simple: plain PHP includes, no framework,
no build step, deployable on any PHP host or as a 3-line Docker image.

Elegance is as much about how it looks as how it's built: a considered palette and
type pairing, consistent spacing and cards, readable text over imagery, and a
polish pass before shipping — not just working PHP.

## Why PHP instead of plain HTML

Static HTML forces you to copy the navbar, `<head>`, and footer into every page;
change a phone number and you edit ten files. PHP fixes this with almost no extra
complexity — you still write mostly HTML, you just stop repeating yourself:

- **Shared includes** — write the navbar/head/footer once, `require` them everywhere.
- **Loops over data** — render a menu of 40 items from one array, not 40 copies.
- **Real behavior** — a contact form that validates and emails, a search page that
  actually filters. Static HTML can't receive input at all.
- **Same hosting story** — drop the files on any PHP host, or deploy the Dockerfile.

## When to use
- "Build me a website for my [bar / cafe / shop / studio]."
- "Scaffold a PHP + Bootstrap site."
- "Convert my HTML site to PHP" / "stop me repeating the navbar on every page."
- "Add a menu / search / contact page to my PHP site." / "Make it deployable."

## Core conventions (do not skip)

1. **App in a subfolder.** Put the site in `app/` (or a brand folder), not the repo
   root. Serve with `php -S localhost:8000` from inside that folder.
2. **Shared includes.** Every page is just:
   ```php
   <?php require_once('includes/head.php') ?>
   <?php require_once('includes/header.php') ?>
   <main> ... page content ... </main>
   <?php require_once('includes/footer.php') ?>
   ```
3. **Theme with CSS variables.** Define the palette and fonts once in `:root` in
   `css/style.css`. Never hardcode the same hex twice.
4. **Data-driven content.** Render cards/menu items by looping a PHP array. If the
   same data feeds two pages, put it in `includes/menu-data.php` and `require` it.
5. **Web-safe asset names** — lowercase, hyphenated, no spaces/accents. Rename on import.
6. **Optimize images** with `scripts/optimize-images.sh`; update `.png` refs to `.jpg`.
7. **SEO + Open Graph** — `head.php` always has `<meta name="description">`, OG tags, favicon.
8. **Security on forms** — validate server-side, strip CR/LF from `mail()` headers,
   escape echoed values with `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`.

## Workflow

1. **Gather the brief** — brand name, what it is, vibe/palette, pages, sections. Infer defaults.
2. **Scaffold** — copy `assets/template/` into `app/`. It has `index.php`, `menu.php`,
   `gallery.php`, `about.php`, `search.php`, `contact.php`, `includes/`, `css/style.css`,
   `Dockerfile`. Replace `{{BRAND}}`, `{{TAGLINE}}`, palette vars, nav links.
3. **Theme it** — pick a look from `references/style-presets.md` (or derive one). A theme
   is the `:root` variables + two Google Fonts (one display, one body).
4. **Fill content** — real items in the PHP data arrays; concrete copy, not generic marketing.
5. **Add & optimize images** — `bash scripts/optimize-images.sh app/assets`.
6. **Verify** — `php -l` every file; `php -S` and curl each page for 200; no missing images.
7. **Deploy** — the `Dockerfile` builds on Render / Railway / Fly. `mail()` needs SMTP on host.

## Design principles (the elegance part)

- One type pairing (display + body). One accent colour; everything else neutral.
- Generous, consistent spacing. Readable text over images (always overlay a gradient).
- Consistent cards (same radius, border, aspect ratio). Restraint over decoration.
- Responsive and fast. If a design feels generic or busy, simplify and commit to the palette.

## Converting an existing static HTML site

1. Lift the repeated `<head>`, navbar, footer into `includes/`.
2. Rename `page.html` → `page.php`; replace the chrome with three `require_once` lines.
3. Turn duplicated markup (cards, rows) into one PHP array + a `foreach` loop.
4. Make dead search boxes / forms work with the `search.php` / `contact.php` patterns.
5. Add meta/OG, optimize images, add the Dockerfile, verify.

## Reference files (read as needed)
- `references/structure-and-conventions.md` — full file map and code patterns.
- `references/style-presets.md` — ready-made themes.
- `references/palettes.pdf` / `palettes.html` — 10 colour schemes + font pairings.
- `assets/template/` — copy-ready starter site.
- `scripts/optimize-images.sh` — the image pipeline.
