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
  <script>document.documentElement.classList.add('js')</script>
  <?php snippet('head') ?>
  <?php snippet('schema-website') ?>
  <?php snippet('schema-person') ?>
  <?php snippet('schema-organization') ?>
</head>

<body class="body">

  <?php if ($page->isHomePage()): ?>

    <?= $slot ?>

  <?php else: ?>

    <?php snippet('banner') ?>
    <?php snippet('navigation-main') ?>

    <?php snippet('schema-breadcrumbs') ?>

    <?= $slot ?>

    <?php if ($page->intendedTemplate()->name() !== 'blog'): ?>
      <?php snippet('scrolltop') ?>
    <?php endif ?>
    <?php snippet('footer') ?>

  <?php endif ?>

  <?php snippet('stoerer') ?>

  <a style="display:none" rel="me" href="https://mastodon.social/@hendrik_berends">Mastodon</a>

  <?= js('assets/js/script.min.js') ?>

</body>

</html>