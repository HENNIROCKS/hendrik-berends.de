<?php

use Kirby\Toolkit\Str;

/**
 * @var \Kirby\Cms\Block $block
 */

?>

<<?= $level = $block->level()->or('h2') ?> class="heading heading--<?= $level ?>" id="<?= Str::slug($block->text()) ?>">
    <?= $block->text() ?>
</<?= $level ?>>