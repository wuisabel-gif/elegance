# Style presets

Every elegance site is themed through CSS variables in `:root`, so a whole look is
just a palette + a type pairing. Start from one of these presets, then adjust. Pick
by the brand's mood, or let the user describe their own and build a fresh set.

Each preset lists the `:root` variables and the two Google Fonts to load.

## Mead Hall — dark, warm, characterful
For bars, taverns, BBQ, anything with fire and atmosphere. (This is the Valhöll look.)
```css
:root {
  --brand: #c79b4b; --brand-lt: #e6c178;
  --bg: #1c140d; --bg-2: #2a1d12; --bark: #3a2a1a;
  --ink: #ece3d2; --muted: #b6ab97;
}
/* Fonts: Cinzel (display) + Spectral (body) */
```

## Editorial — light, refined, serif
For studios, boutiques, restaurants, portfolios that want "quiet luxury".
```css
:root {
  --brand: #a9824c; --brand-lt: #c2a06a;
  --bg: #f7f3ec; --bg-2: #efe8dc; --bark: #e2d8c8;
  --ink: #1d1b17; --muted: #5b5650;
}
/* Fonts: Cormorant Garamond (display) + Spectral (body) */
```

## Minimal — white, black, no ornament
For tech, agencies, anything that wants to feel clean and confident.
```css
:root {
  --brand: #111111; --brand-lt: #444444;
  --bg: #ffffff; --bg-2: #f5f5f5; --bark: #e2e2e3;
  --ink: #111111; --muted: #6b6b6b;
}
/* Fonts: Space Grotesk (display) + Inter (body) */
```

## Aurora — near-black, neon glow, geometric
For dev tools, launches, nightlife. Use the accent at low opacity for glows and
hairline borders (radial gradients, soft shadows), not big solid fills.
```css
:root {
  --brand: #8b7cff; --brand-lt: #38bdf8;
  --bg: #0d0b1a; --bg-2: #15122a; --bark: #2a2640;
  --ink: #e8e6f5; --muted: #a59fc4;
}
/* Fonts: Space Grotesk (display) + Inter (body) */
```

## Choosing & customizing
- Match the palette to the brand's room: dark and warm for a bar, bright and clean
  for a clinic, near-black with a neon accent for a software launch.
- Keep it to **one accent** plus neutrals. The accent carries buttons, links, and a
  few key numbers — nothing else.
- One display face for headings, one readable face for body. Load only those two.
- If the user names a vibe ("playful", "expensive", "brutalist"), derive a fresh
  preset in the same shape rather than forcing one of the above.
