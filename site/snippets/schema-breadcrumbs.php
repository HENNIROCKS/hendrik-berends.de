<?php

/**
 * @var \Kirby\Cms\Page $page
 */

$trail = $page->parents()->flip()->add($page);

$items = [];
$position = 1;

foreach ($trail as $crumb) {
    $items[] = [
        '@type'    => 'ListItem',
        'position' => $position++,
        'name'     => $crumb->title()->value(),
        'item'     => $crumb->url(),
    ];
}

$data = [
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => $items,
];

?>
<script type="application/ld+json"><?= json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
