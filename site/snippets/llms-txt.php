<?php

/**
 * @var \Kirby\Cms\Site $site
 *
 * Spec: https://llmstxt.org/
 */

$aboutPage    = page('page://xfzvptqdbmnlbcil');
$portfolio    = collection('portfolio-pages');
$blogArticles = collection('blog-articles')->limit(20);

?>
# <?= $site->title() ?>

> <?= $site->description() ?>

## Über mich

<?php if ($aboutPage): ?>
- [<?= $aboutPage->title() ?>](<?= $aboutPage->url() ?>)
<?php endif ?>

## Portfolio

<?php foreach ($portfolio as $project): ?>
- [<?= $project->title() ?>](<?= $project->url() ?>)
<?php endforeach ?>

## Blog

<?php foreach ($blogArticles as $article): ?>
- [<?= $article->title() ?>](<?= $article->url() ?>)<?php if ($article->description()->isNotEmpty()): ?>: <?= $article->description() ?><?php endif ?>

<?php endforeach ?>
