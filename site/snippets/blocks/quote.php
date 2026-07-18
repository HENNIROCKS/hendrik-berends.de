<?php

/**
 * @var \Kirby\Cms\Block $block
 */

?>

<blockquote class="quote">

    <span class="quote__text">
        <!-- <i class="quote__icon quote__icon--chevron-right-double"></i> -->
        <?= $block->text() ?>
        <!-- <i class="quote__icon quote__icon--chevron-left-double"></i> -->
    </span>

    <?php if ($block->citation()->isNotEmpty()): ?>
        <footer class="quote__footer">
            <?= $block->citation() ?>
        </footer>
    <?php endif ?>

</blockquote>