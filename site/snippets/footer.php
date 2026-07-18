<?php

// use Kirby\Toolkit\I18n;
// use Kirby\Toolkit\Str;

/**
 * @var \Kirby\Cms\Site $site
 */

$text = $site->footertext()->or('Made with Kirby and <i class="icon icon__heart"></i> &copy; (date: year)');

?>

<footer class="footer">

    <div class="footer__top">
        <?php if ($text->isNotEmpty()) : ?>
            <div class="footer__text">
                <?= $text->kt() ?>
            </div>
        <?php endif ?>

        <?php snippet('list-icons', ['class' => 'footer']) ?>
    </div>

    <div class="footer__bottom">
        <?php snippet('navigation-footer') ?>
    </div>

</footer>