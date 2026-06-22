#!/usr/bin/env bash
# Optimize a site's image assets (macOS, uses built-in `sips`).
#
# Usage:  bash optimize-images.sh path/to/app/assets [logo-filename]
#
# - Converts every photo PNG (RGB, no alpha) to JPEG (q82, max 1400px) and removes the PNG.
# - Shrinks the logo to 256px wide but keeps it PNG (transparency).
# - Generates favicon.png (48px) and apple-touch-icon.png (180px) from the logo.
#
# After running, update code references from "<name>.png" to "<name>.jpg" for the
# converted files (everything except the logo / favicon / apple-touch-icon).

set -euo pipefail

DIR="${1:?Usage: optimize-images.sh <assets-dir> [logo-filename]}"
LOGO="${2:-logo.png}"
cd "$DIR"

KEEP="$LOGO favicon.png apple-touch-icon.png"

before=$(du -sh . | cut -f1)

# Logo: shrink + favicons (only if present)
if [ -f "$LOGO" ]; then
  sips -Z 256 "$LOGO" --out "$LOGO" >/dev/null
  sips -Z 48  "$LOGO" --out favicon.png >/dev/null
  sips -Z 180 "$LOGO" --out apple-touch-icon.png >/dev/null
  echo "logo shrunk; favicon.png + apple-touch-icon.png generated"
fi

# Convert photo PNGs -> JPEG
shopt -s nullglob
converted=0
for f in *.png; do
  case " $KEEP " in *" $f "*) continue;; esac
  base="${f%.png}"
  if sips -Z 1400 -s format jpeg -s formatOptions 82 "$f" --out "$base.jpg" >/dev/null 2>&1; then
    rm -f "$f"
    converted=$((converted+1))
  fi
done

after=$(du -sh . | cut -f1)
echo "converted $converted PNG photos to JPEG"
echo "assets size: $before -> $after"
echo "REMINDER: replace '<name>.png' -> '<name>.jpg' in code for the converted files."
