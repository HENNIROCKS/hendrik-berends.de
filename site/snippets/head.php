<?php

/**
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Cms\Site $site
 */

$title       = $page->customtitle()->or($site->customtitle());
$author      = $page->author()->or($site->author());
$description = $page->description()->or($site->description());
$keywords    = $page->keywords()->or($site->keywords());
$robots      = $page->robots();

?>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php e($title->isNotEmpty(), esc($title), esc($page->title() . ' – ' . $site->title())) ?></title>

<meta name="author" content="<?= esc($author) ?>">

<meta name="description" content="<?= esc($description) ?>">

<meta name="keywords" content="<?= esc($keywords) ?>">

<meta name="robots" content="<?php e($robots->toBool() === true, 'noindex, nofollow', 'index, follow') ?>">

<?= css('assets/css/theme.min.css') ?>

<?= css('assets/css/style.min.css') ?>

<link rel="shortcut icon" href="/favicon.ico">
