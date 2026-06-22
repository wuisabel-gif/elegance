# Structure & conventions

## Repo layout

```
my-site/                  # repo root
├─ app/                   # the website (served by PHP) — rename to brand if you like
│  ├─ index.php           # home
│  ├─ menu.php            # a data-driven listing page
│  ├─ search.php          # searches the shared data array
│  ├─ contact.php         # validated form (POST handled at top, before output)
│  ├─ css/
│  │  └─ style.css        # CSS-variable theme on top of Bootstrap
│  ├─ includes/
│  │  ├─ head.php         # <!doctype> .. <head> .. <body> open: meta, OG, fonts, favicon, css
│  │  ├─ header.php       # navbar (logo + links + search form)
│  │  ├─ footer.php       # footer + Bootstrap JS + </body></html>
│  │  └─ menu-data.php    # the shared content array ($items)
│  └─ assets/             # images (web-safe slug names), favicon, videos
├─ Dockerfile            # php:8.2-apache, copies app/ to web root
├─ .gitignore            # .DS_Store
└─ README.md
```

## The include chain

Every page:
```php
<?php require_once('includes/head.php') ?>
<?php require_once('includes/header.php') ?>
<main>
    <!-- page content -->
</main>
<?php require_once('includes/footer.php') ?>
```
`head.php` opens `<html><head>…</head><body>`; `footer.php` closes `</body></html>`.
Relative `src`/`href` in includes resolve against the **page** URL (all pages sit
in the app root), so use `assets/x.jpg` and `css/style.css` — not `../`.
Exception: relative `url()` inside `css/style.css` resolves against the **CSS file**,
so use `../assets/x.jpg` there.

## CSS-variable theme

```css
:root {
  --brand:      #c79b4b;   /* primary / accent */
  --brand-lt:   #e6c178;
  --bg:         #1c140d;   /* page background */
  --bg-2:       #2a1d12;   /* cards / panels */
  --ink:        #ece3d2;   /* body text */
}
body { background: var(--bg); color: var(--ink); font-family: 'Body', serif; }
h1,h2,h3,.navbar-brand { font-family: 'Display', serif; }
```
Load two Google Fonts in `head.php` (one display, one body). Override Bootstrap by
adding classes (`.btn-brand`) rather than editing Bootstrap.

## Data-driven cards

Define items as a PHP array, loop to render. One source of truth:
```php
// includes/menu-data.php
$items = [
  'Section A' => [
    // [name, price, description, image]
    ['Item One', '12', 'Short, concrete description.', 'assets/item-one.jpg'],
  ],
];
```
```php
// menu.php
require('includes/menu-data.php');
foreach ($items as $section => $rows): ?>
  <h2 class="section-title"><?php echo $section; ?></h2>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
    <?php foreach ($rows as $r): ?>
      <div class="col"><div class="card-x h-100">
        <img class="card-photo" src="<?php echo $r[3]; ?>" alt="<?php echo strip_tags($r[0]); ?>" loading="lazy">
        <div class="card-body-x">
          <div class="d-flex justify-content-between">
            <h3 class="card-name"><?php echo $r[0]; ?></h3>
            <span class="card-price"><?php echo $r[1]; ?></span>
          </div>
          <p class="card-desc"><?php echo $r[2]; ?></p>
        </div>
      </div></div>
    <?php endforeach; ?>
  </div>
<?php endforeach;
```

## Search page

Reuse the shared array. Match name + description + section, decode entities, fold case:
```php
require('includes/menu-data.php');
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$results = [];
if ($q !== '') {
  $needle = mb_strtolower(html_entity_decode($q, ENT_QUOTES, 'UTF-8'));
  foreach ($items as $section => $rows) foreach ($rows as $r) {
    $hay = mb_strtolower(html_entity_decode($r[0].' '.$r[2].' '.$section, ENT_QUOTES, 'UTF-8'));
    if (mb_strpos($hay, $needle) !== false) $results[] = ['item'=>$r,'section'=>$section];
  }
}
```
Navbar form: `<form role="search" action="search.php" method="get">` with
`<input name="q" value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q'], ENT_QUOTES, 'UTF-8') : '' ?>">`.

## Contact / reservation form (security matters)

Handle POST at the very top of the file, before any HTML output. Rules:
- Validate each field; collect missing ones into an error message.
- `filter_var($email, FILTER_VALIDATE_EMAIL)`.
- **Header-injection guard:** before using a value in a mail header, strip CR/LF:
  `$safe = preg_replace('/[\r\n]+/', ' ', $value);`
- Escape every echoed user value: `htmlspecialchars($v, ENT_QUOTES, 'UTF-8')`.
- `mail()` returns false if the host can't hand off; show a fallback (phone).
- On a real host, `mail()` needs SMTP configured — say so. Consider a form service
  (Formspree / Web3Forms) instead for guaranteed delivery.

## Asset & image rules

- Rename every imported image to a lowercase-hyphen slug, no spaces/accents.
- Run `scripts/optimize-images.sh <app>/assets`: photo PNGs → JPEG (q82, max 1400px),
  logo shrunk to 256px (keeps transparency), `favicon.png` (48px) +
  `apple-touch-icon.png` (180px) generated from the logo.
- After converting, replace `.png` → `.jpg` for the converted files in all code.
  Keep PNG only for transparent assets (logo, favicon).
- Big background photos: layer a dark/light gradient over them in CSS so text stays
  readable: `background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.85)), url(...)`.

## SEO + Open Graph (in head.php)

```html
<meta name="description" content="One concrete sentence about the brand.">
<meta property="og:type" content="website">
<meta property="og:title" content="{{BRAND}} — {{TAGLINE}}">
<meta property="og:description" content="...">
<meta property="og:url" content="https://your-url">
<meta property="og:image" content="https://your-url/assets/hero.jpg">
<meta name="twitter:card" content="summary_large_image">
```

## Deploy

`Dockerfile`:
```dockerfile
FROM php:8.2-apache
COPY app/ /var/www/html/
EXPOSE 80
```
Render: New Web Service → connect repo → it detects the Dockerfile → builds. Free
tier sleeps when idle. Set the live URL as the repo homepage and in the README.

## Copy/voice

Write concrete before abstract. Avoid hollow adjectives (seamless, unforgettable),
throat-clearing openers, and reflexive triads. Vary sentence length. A short
fragment after a long sentence reads human. Keep one consistent brand voice across
every page.

## Verify checklist
- [ ] `php -l` clean on all `.php`
- [ ] every page HTTP 200 under `php -S`
- [ ] every referenced image exists; no orphans
- [ ] search returns results; empty + no-result states handled
- [ ] form validates, rejects bad email, guards mail headers, escapes output
- [ ] head.php has description + OG + favicon
