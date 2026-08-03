<?php

/**
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Cms\Site $site
 */

$title       = $page->isHomePage() ? $page->customtitle()->or($site->customtitle()) : $page->customtitle();
$author      = $page->author()->or($site->author());
$description = $page->description()->or($site->description());
$keywords    = $page->keywords()->or($site->keywords());
$robots      = $page->robots();

$titleText = $title->isNotEmpty() ? $title->value() : $page->title() . ' – ' . $site->title();

$paginationPage = (int)param('page');
$tagParam       = param('tag');

if ($paginationPage > 1) {
    $titleText .= ' – Seite ' . $paginationPage;
}

$canonicalUrl = url($page->url(), [
    'params' => array_filter([
        'tag'  => $tagParam ? urlencode($tagParam) : null,
        'page' => $paginationPage > 1 ? $paginationPage : null,
    ]),
]);

$isArticle = $page->intendedTemplate()->name() === 'blog-article';
$ogImage   = $page->previewimage()->toFile() ?? $site->ogimage()->toFile();

?>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= esc($titleText) ?></title>

<meta name="author" content="<?= esc($author) ?>">

<meta name="description" content="<?= esc($description) ?>">

<meta name="keywords" content="<?= esc($keywords) ?>">

<meta name="robots" content="<?php e($robots->toBool() === true, 'noindex, nofollow', 'index, follow') ?>">

<link rel="canonical" href="<?= esc($canonicalUrl) ?>">

<meta property="og:title" content="<?= esc($titleText) ?>">
<meta property="og:description" content="<?= esc($description) ?>">
<meta property="og:type" content="<?= $isArticle ? 'article' : 'website' ?>">
<meta property="og:url" content="<?= esc($canonicalUrl) ?>">
<?php if ($ogImage): ?>
    <meta property="og:image" content="<?= esc($ogImage->url()) ?>">
<?php endif ?>

<meta name="twitter:card" content="<?= $ogImage ? 'summary_large_image' : 'summary' ?>">
<meta name="twitter:title" content="<?= esc($titleText) ?>">
<meta name="twitter:description" content="<?= esc($description) ?>">
<?php if ($ogImage): ?>
    <meta name="twitter:image" content="<?= esc($ogImage->url()) ?>">
<?php endif ?>

<?= css('assets/css/theme.min.css') ?>

<?= css('assets/css/style.min.css') ?>

<link rel="shortcut icon" href="/favicon.ico">
