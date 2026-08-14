<?php

/**
 * Renders an icon from the sprite inlined by the `sprite` snippet.
 *
 * Icons are decorative here — the surrounding link or button carries the
 * accessible name, so the SVG is hidden from assistive technology. Pass a
 * `label` when an icon stands alone and has to speak for itself.
 *
 * @var string $name Symbol name without the `icon-` prefix, e.g. "mastodon"
 * @var string|null $class Extra classes, e.g. "icon--lg"
 * @var string|null $label Accessible name; omit for decorative icons
 */

$name = $name ?? null;
$class = $class ?? null;
$label = $label ?? null;

if (empty($name)) {
  return;
}

?>
<svg class="icon<?= $class ? ' ' . esc($class) : '' ?>" <?php if ($label): ?>role="img" aria-label="<?= esc($label) ?>"<?php else: ?>aria-hidden="true" focusable="false"<?php endif ?>>
  <use href="#icon-<?= esc($name) ?>"></use>
</svg>
