<?php

/**
 * @var Kirby\Cms\Page $page
 * @var Kirby\Cms\Site $site
 */

$image  = $page->previewimage()->toFile();
$author = $page->author()->or($site->author())->value();

$data = [
    '@context'         => 'https://schema.org',
    '@type'            => 'BlogPosting',
    'headline'         => $page->title()->value(),
    'datePublished'    => date('c', $page->date()->toTimestamp()),
    'dateModified'     => date('c', $page->modified()),
    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id'   => $page->url(),
    ],
];

if ($author) {
    $data['author'] = [
        '@id' => $site->url() . '#person',
    ];
}

if ($image) {
    $data['image'] = $image->url();
}

if ($description = $page->description()->or($site->description())->value()) {
    $data['description'] = $description;
}

?>
<script type="application/ld+json"><?= json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
