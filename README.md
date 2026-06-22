<p align="center">
  <img src="logo.png" alt="elegance logo" width="120">
</p>

<h1 align="center">elegance</h1>

<p align="center">A Claude skill for beautiful PHP + Bootstrap sites &middot; 🌐 <a href="https://wuisabel-gif.github.io/elegance/"><strong>Live demo</strong></a></p>

A Claude skill for building good-looking PHP + Bootstrap websites, or turning a
static HTML site into PHP. It sets up the theme and the shared layout, adds a
menu, search, and contact page, shrinks the images, and gets everything ready to
deploy. The point is that the site looks finished, not just that the PHP runs.

## Why bother

The look of a site isn't decoration — it's the first thing a customer reacts to,
and the numbers are blunt:

- **50 milliseconds** — how long it takes someone to form a first impression of
  your site (Lindgaard et al., 2006).
- **94%** of that first impression is design, not content (Sweor / ResearchGate).
- **75%** of people judge a company's credibility on its website design alone
  (Stanford Web Credibility Project).
- **38%** stop engaging with a site when the layout is unattractive (Adobe).
- **88%** of visitors are less likely to return after one bad experience.
- **53%** of mobile visitors leave if a page takes longer than 3 seconds to load
  (Google).

Most small-business sites still look templated — a stock photo and a font nobody
picked — and the numbers above are what that quietly costs them. Looking better
used to take a designer, a developer, and a few weeks. It doesn't anymore. elegance
gives you a site that looks considered, loads fast, runs on plain PHP you can host
almost anywhere, and stays easy to change. Look like you meant it — without the
agency bill.

<sub>Figures are widely-cited UX and web-credibility findings; treat them as directional.</sub>

## Why PHP instead of plain HTML

With plain HTML you copy the navbar, the `<head>`, and the footer into every page.
Change a phone number and you have to edit all of them. PHP lets you write those
once and pull them into each page with `require`. You can build a list of forty
items from a single array instead of forty copied blocks, and you can add things
HTML can't do on its own, like a contact form that sends mail or a search box that
actually filters. The hosting is just as simple either way.

## Install

Works as a **Claude skill** and a **Gemini CLI extension** — same content, two entry
points (`SKILL.md` for Claude, `GEMINI.md` for Gemini).

**Claude** — copy the folder into your skills directory:

```bash
cp -R elegance ~/.claude/skills/elegance
```

The folder name becomes the skill's id; keep the file named `SKILL.md`. Restart
Claude Code if it's already open.

**Gemini CLI** — install it as an extension:

```bash
gemini extensions install https://github.com/wuisabel-gif/elegance
```

…or clone it into `~/.gemini/extensions/elegance`. Gemini reads `gemini-extension.json`
and loads `GEMINI.md` as context.

## How to use it

Ask for what you want. For example:
- "Build me a PHP + Bootstrap site for a coffee shop called Emberhaus."
- "Use elegance to add a menu and a search page to my site."

It asks a few questions, copies the starter template into an `app/` folder, themes
it, drops in your content, shrinks the images, checks that everything works, and
sets up the deploy.

## What's in here

```
SKILL.md                                  the instructions Claude reads
references/structure-and-conventions.md   the full file map and code patterns
scripts/optimize-images.sh                PNG to JPEG, logo shrink, favicon (macOS sips)
assets/template/                          a working starter site to copy
  index.php menu.php gallery.php about.php search.php contact.php
  includes/{head,header,footer,menu-data}.php
  css/style.css
  Dockerfile
```

## Running a site locally

```bash
cd app
php -S localhost:8000
```

## Deploying

The Dockerfile uses `php:8.2-apache` and copies the `app/` folder. Push to GitHub,
make a Web Service on Render, Railway, or Fly, and it builds on its own. One catch:
`mail()` won't send anything until you set up SMTP on the host.
