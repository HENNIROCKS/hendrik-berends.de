<?php

/**
 * Inlines the icon sprite once per document.
 *
 * Inlined rather than referenced as an external file: `<use>` pointing at a
 * separate SVG does not reliably inherit `currentColor` across browsers, and
 * the icons have to follow the light/dark switch. ~10 KB gzipped.
 *
 * Generated from assets/fonts/remix.svg (IcoMoon subset) plus the two brand
 * marks that were not part of it. Regenerate when icons change.
 */

echo svg('assets/icons/sprite.svg');
