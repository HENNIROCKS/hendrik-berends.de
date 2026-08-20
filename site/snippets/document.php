<?php

/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Template\Slot $slot
 */

?>

<!DOCTYPE html>
<html class="motion-safe:scroll-smooth" lang="de">

<head>
  <script>
    document.documentElement.classList.add('js')
  </script>
  <?php snippet('head') ?>
  <?php snippet('schemas/schema-website') ?>
  <?php snippet('schemas/schema-person') ?>
  <?php snippet('schemas/schema-organization') ?>
</head>

<?php // overflow-x-clip: without JS, the full-bleed slider block falls back to
  // a 100vw breakout that overshoots by the scrollbar width. clip avoids a
  // new scroll container, which would break position: sticky. ?>
<body class="font-display text-md font-normal bg-background text-foreground overflow-x-clip">
  <?php snippet('sprite') ?>

  <?php if ($page->isHomePage()): ?>

    <?= $slot ?>

  <?php else: ?>

    <?php snippet('banner') ?>
    <?php snippet('navigation-main') ?>
    <?php snippet('schemas/schema-breadcrumbs') ?>

    <?= $slot ?>

    <?php /* if ($page->intendedTemplate()->name() !== 'blog' && !isArticleLocked($page)): ?>
      <?php snippet('scrolltop') ?>
    <?php endif */ ?>

    <?php snippet('footer') ?>

  <?php endif ?>

  <?php snippet('stoerer') ?>

  <a class="hidden" href="https://mastodon.social/@hendrik_berends" rel="me">Mastodon</a>

  <?= js('assets/js/script.min.js') ?>
</body>

</html>