<?php

/**
 * Inlines the icon sprite once per document.
 *
 * Inlined rather than referenced as an external file: `<use>` pointing at a
 * separate SVG does not reliably inherit `currentColor` across browsers, and
 * the icons have to follow the light/dark switch. ~10 KB gzipped.
 *
 * The symbols are RemixIcon glyphs plus two brand marks that RemixIcon does
 * not carry. To add one, take the SVG from remixicon.com, drop its <svg>
 * wrapper into a <symbol id="icon-name" viewBox="…"> here, and keep the fill
 * on currentColor — only `cara` and its gradient are exempt from that.
 */

echo svg('assets/icons/sprite.svg');
