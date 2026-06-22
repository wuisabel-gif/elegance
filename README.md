# elegance (Claude skill)

A Claude skill for building good-looking PHP + Bootstrap websites, or turning a
static HTML site into PHP. It sets up the theme and the shared layout, adds a
menu, search, and contact page, shrinks the images, and gets everything ready to
deploy. The point is that the site looks finished, not just that the PHP runs.

## Why bother

Most small-business sites look the same: a template, a stock photo, a font nobody
picked. People notice. They decide whether they trust a place in about a second,
before they read a word, and a site that looks thrown together makes a real
business look careless.

Looking better than that used to cost a designer, a developer, and a few weeks. It
doesn't anymore. elegance gives you a site that looks considered, runs on plain PHP
you can host almost anywhere, and stays easy to change later. Look like you meant
it — without the agency bill.

## Why PHP instead of plain HTML

With plain HTML you copy the navbar, the `<head>`, and the footer into every page.
Change a phone number and you have to edit all of them. PHP lets you write those
once and pull them into each page with `require`. You can build a list of forty
items from a single array instead of forty copied blocks, and you can add things
HTML can't do on its own, like a contact form that sends mail or a search box that
actually filters. The hosting is just as simple either way.

## Install

Copy the folder into your Claude skills directory:

```bash
cp -R elegance ~/.claude/skills/elegance
```

The folder name becomes the skill's id, and the file has to stay named `SKILL.md`.
Restart Claude Code if it's already open.

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
