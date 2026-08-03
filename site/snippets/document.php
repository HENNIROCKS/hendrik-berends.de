<?php

/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Template\Slot $slot
 */

?>

<!DOCTYPE html>
<html class="scroll-smooth" lang="de">

<head>
    <?php snippet('head') ?>
</head>

<body class="body">

    <?php if ($page->isHomePage()): ?>

        <?= $slot ?>

    <?php else: ?>

        <?php snippet('banner') ?>
        <?php snippet('navigation-main') ?>

        <?= $slot ?>

        <?php if ($page->intendedTemplate()->name() !== 'blog'): ?>
            <?php snippet('scrolltop') ?>
        <?php endif ?>
        <?php snippet('footer') ?>

    <?php endif ?>

    <?php snippet('stoerer') ?>

    <a style="display: none" href="https://mastodon.social/@hennirocks_designer" rel="me">Mastodon</a>

    <?= js('assets/js/script.min.js') ?>

</body>

</html>