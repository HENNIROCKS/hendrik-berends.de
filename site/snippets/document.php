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
  <script>
    document.documentElement.classList.add('js')
  </script>
  <?php snippet([
    'head',
    'schemas/schema-website',
    'schemas/schema-person',
    'schemas/schema-organization',
  ]) ?>
</head>

<body class="body">
  <?php if ($page->isHomePage()): ?>

    <?= $slot ?>

  <?php else: ?>

    <?php snippet([
      'banner',
      'navigation-main',
      'schemas/schema-breadcrumbs',
    ]) ?>

    <?= $slot ?>

    <?php if ($page->intendedTemplate()->name() !== 'blog' && !isArticleLocked($page)): ?>
      <?php snippet('scrolltop') ?>
    <?php endif ?>

    <?php snippet('footer') ?>

  <?php endif ?>

  <?php snippet('stoerer') ?>

  <a class="hidden" rel="me" href="https://mastodon.social/@hendrik_berends">Mastodon</a>

  <?= js('assets/js/script.min.js') ?>
</body>

</html>