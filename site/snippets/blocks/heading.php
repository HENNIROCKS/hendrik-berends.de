<?php

use Kirby\Toolkit\Str;

/**
 * @var \Kirby\Cms\Block $block
 */

/**
 * Level and visual size are separate concerns, so the size is picked here
 * instead of being built into a class name. A `heading--<?= $level ?>` would
 * be invisible to Tailwind, which only ever scans for literal strings — this
 * match keeps every possible class in the source as written-out text.
 *
 * The level goes through a match of its own, because it ends up as the tag
 * name: passing the field value straight into the markup would put whatever
 * a content file happens to hold between the angle brackets.
 */
$level = match ($block->level()->or('h2')->toString()) {
    'h1'    => 'h1',
    'h3'    => 'h3',
    'h4'    => 'h4',
    'h5'    => 'h5',
    'h6'    => 'h6',
    default => 'h2',
};

$size = match ($level) {
    'h1'    => 'text-2xl',
    'h2'    => 'text-xl',
    'h3'    => 'text-lg',
    default => 'text-md',
};

?>

<<?= $level ?> class="mb-md font-bold <?= $size ?>" id="<?= Str::slug($block->text()) ?>">
    <?= $block->text() ?>
</<?= $level ?>>
