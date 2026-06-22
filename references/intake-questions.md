# Intake questions

Ask these when the skill is invoked, to gather the brief before building. Don't
fire all of them at once — lead with the four ★ essentials, infer sensible
defaults for the rest, and confirm. If the user says "just build something," pick
defaults and show a draft instead of interrogating them.

## ★ The essentials (ask first)

1. **What's the business, and what's it called?** (e.g. "a nail salon called Lumi")
2. **Where is it / who's it for?** (city, neighborhood, the kind of customer)
3. **What's the one thing a visitor should do?** (book a table, call, order, get a
   quote, sign up) — this becomes the primary button everywhere.
4. **Which pages do you need?** (Home is assumed. Menu? Gallery? About? Contact?
   Services? Pricing?)

## Look & feel

5. **What mood are you going for?** (warm & cozy, clean & clinical, bold & modern,
   soft & elegant, playful…) — or pick a preset: Mead Hall, Editorial, Minimal,
   Aurora, Blush, Warm, Clinical, Scholarly, Botanical, Mono Tech.
6. **Any brand colors already?** (hex codes, or "match my logo")
7. **Font preference?** (have one in mind, or want a display + body pairing chosen)
8. **Any sites you like the look of?** (a link or two to steer the style)
9. **Light or dark theme?**

## Content & assets

10. **Do you have a logo?** (file, or should one be designed / a text wordmark used)
11. **Do you have photos?** (or use placeholders / AI-generated for now)
12. **What goes on the menu / services / product list?** (names, short descriptions,
    prices) — this fills the data array.
13. **Your story / "about" copy** — a few sentences, or should it be drafted?
14. **Real details:** address, hours, phone, email, social links, a map location.

## Functionality

15. **Contact or reservation form?** (and which fields — name, email, date, party size, message)
16. **Where should form submissions go?** (an inbox email; note `mail()` needs SMTP,
    or use a form service like Formspree/Web3Forms for guaranteed delivery)
17. **Search the menu/content?** (yes/no)
18. **Gallery with a lightbox?** (yes/no, how many photos)
19. **Embedded map?** (the address to center on)
20. **Any extras?** (booking link, online ordering, newsletter signup, multiple languages)

## Practical / launch

21. **Where will it be hosted?** (Render / Railway / Fly via the Dockerfile, or a
    PHP shared host, or GitHub Pages if it can be static)
22. **Do you have a domain?** (or use the host's free subdomain for now)
23. **A deadline or a "good enough for now" bar?**
24. **Single language or more than one?**

## How to use this list
- Ask the ★ four, then 2–3 from Look & feel, then move. Batch related questions.
- For anything the user skips, choose a sensible default and say what you chose.
- Reflect the brief back in one line before building, then scaffold from the template.
