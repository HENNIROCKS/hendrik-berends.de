<?php

/**
 * @var \Kirby\Cms\Site $site
 */

// The trailing colon is not a typo: Kirby only recognises a KirbyTag as
// "(name: value)", so a value-less tag still needs it. The text runs through
// kt() below, which is what expands it.
$text = $site->footertext()->or('Made with Kirby and (heart: ) &copy; ' . date('Y'));

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