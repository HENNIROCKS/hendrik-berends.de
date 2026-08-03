<?php

/**
 * @var \Kirby\Cms\Site $site
 */

$aboutPage = page('page://xfzvptqdbmnlbcil');

$data = [
    '@context' => 'https://schema.org',
    '@type'    => 'Person',
    '@id'      => $site->url() . '#person',
    'name'     => 'Hendrik Berends',
    'jobTitle' => 'Diplom-Designer & Frontend Developer',
    'sameAs'   => [
        'https://github.com/hennirocks',
        'https://www.linkedin.com/in/hendrik-berends/',
        'https://bsky.app/profile/hendrik-berends.bsky.social',
    ],
    'owns' => [
        '@id' => $site->url() . '#foerdeliebe',
    ],
];

if ($aboutPage) {
    $data['url'] = $aboutPage->url();
}

?>
<script type="application/ld+json"><?= json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
