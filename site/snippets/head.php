<?php

/**
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Cms\Site $site
 */

$isPrivate = $page->private()->toBool();
$isLocked  = isArticleLocked($page);

$title       = $isLocked ? $site->customtitle() : ($page->isHomePage() ? $page->customtitle()->or($site->customtitle()) : $page->customtitle());
$author      = $page->author()->or($site->author());
$description = $isLocked ? $site->description() : $page->description()->or($site->description());
$keywords    = $isLocked ? $site->keywords() : $page->keywords()->or($site->keywords());
$robots      = $page->robots();

$titleText = $title->isNotEmpty() ? $title->value() : ($isLocked ? $site->title() : $page->title() . ' – ' . $site->title());

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

$isArticle = $page->intendedTemplate()->name() === 'blog-article' && $isLocked === false;
$ogImage   = $isLocked ? $site->ogimage()->toFile() : ($page->previewimage()->toFile() ?? $site->ogimage()->toFile());
$aboutPage = page('page://xfzvptqdbmnlbcil');

?>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= esc($titleText) ?></title>

<meta name="author" content="<?= esc($author) ?>">

<meta name="description" content="<?= esc($description) ?>">

<meta name="keywords" content="<?= esc($keywords) ?>">

<meta name="robots" content="<?php e($robots->toBool() === true || $isPrivate, 'noindex, nofollow', 'index, follow') ?>">

<link rel="canonical" href="<?= esc($canonicalUrl) ?>">

<link rel="alternate" type="application/rss+xml" title="<?= esc($site->title()) ?> – Blog" href="<?= esc(url('blog/feed.xml')) ?>">

<meta property="og:title" content="<?= esc($titleText) ?>">
<meta property="og:description" content="<?= esc($description) ?>">
<meta property="og:type" content="<?= $isArticle ? 'article' : 'website' ?>">
<meta property="og:url" content="<?= esc($canonicalUrl) ?>">
<meta property="og:locale" content="de_DE">
<?php if ($ogImage): ?>
    <meta property="og:image" content="<?= esc($ogImage->url()) ?>">
<?php endif ?>

<?php if ($isArticle): ?>
    <meta property="article:published_time" content="<?= esc(date('c', $page->date()->toTimestamp())) ?>">
    <meta property="article:modified_time" content="<?= esc(date('c', $page->modified())) ?>">
    <?php if ($aboutPage): ?>
        <meta property="article:author" content="<?= esc($aboutPage->url()) ?>">
    <?php endif ?>
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
