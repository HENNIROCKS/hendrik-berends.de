<?php

/**
 * @var \Kirby\Cms\Block $block
 */

?>

<blockquote class="quote">

    <span class="quote__text">
        <?= $block->text() ?>
    </span>

    <?php if ($block->citation()->isNotEmpty()): ?>
        <footer class="quote__footer">
            <?= $block->citation() ?>
        </footer>
    <?php endif ?>

</blockquote>