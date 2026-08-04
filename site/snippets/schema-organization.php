<?php

/**
 * @var \Kirby\Cms\Site $site
 */

$data = [
    '@context' => 'https://schema.org',
    '@type'    => 'Organization',
    '@id'      => $site->url() . '#foerdeliebe',
    'name'     => 'foerdeliebe.sh',
    'url'      => 'https://foerdeliebe.sh',
];

?>
<script type="application/ld+json"><?= json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
