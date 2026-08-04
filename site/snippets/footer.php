<?php

/**
 * @var \Kirby\Cms\Site $site
 */

$text = $site->footertext()->or('Made with Kirby and <i class="icon icon--heart"></i> &copy; ' . date('Y'));

?>

<footer class="footer">

    <div class="footer__top">
        <div class="footer__text">
            <?php if ($text->isNotEmpty()) : ?>
                <?= $text->kt() ?>
            <?php endif ?>
            <?php snippet('website-carbon') ?>
        </div>

        <div class="footer__meta">
            <?php snippet('list-icons', ['class' => 'footer']) ?>
        </div>
    </div>

    <div class="footer__bottom">
        <?php snippet('navigation-footer') ?>
    </div>

</footer>