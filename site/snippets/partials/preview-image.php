<?php

/**
 * @var \Kirby\Cms\File $image
 * @var string $alt
 * @var string $imgClass Classes for the <img>; the <picture> gets none
 * @var bool $critical
 * @var string $srcsetName
 */

$sizes = '(min-width: 768px) 33vw, 100vw';

// An element without classes gets no `class` key at all: imagex merges the
// attribute by splitting it on spaces and chokes on null. The <picture> is
// sized by whatever wrapper utility the caller put on its parent, so it
// never carries classes of its own.
$imgClass = $imgClass ?? null;

$imgAttributes = ['alt' => $alt, 'sizes' => $sizes];

if ($imgClass) {
    $imgAttributes['class'] = $imgClass;
}

?>

<?php snippet('imagex-picture', [
    'image' => $image,
    'ratio' => '640/250',
    'srcsetName' => $srcsetName ?? 'preview',
    'critical' => $critical ?? false,
    'imgAttributes' => [
        'shared' => $imgAttributes,
    ],
    'pictureAttributes' => [
        'shared' => [],
    ],
    'sourcesAttributes' => [
        'shared' => ['sizes' => $sizes],
    ],
]) ?>
