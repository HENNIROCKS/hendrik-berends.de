<?php

/**
 * @var \Kirby\Cms\File $image
 * @var string $alt
 * @var string $class Legacy BEM base name; the <picture> gets it suffixed "-wrap"
 * @var string $imgClass Classes for the <img>, overrides $class
 * @var string $pictureClass Classes for the <picture>, overrides $class . "-wrap"
 * @var bool $critical
 * @var string $srcsetName
 */

$sizes = '(min-width: 768px) 33vw, 100vw';

// Callers still on the BEM stylesheet pass a single `class` and rely on the
// "-wrap" suffix; migrated ones name both elements explicitly, because a
// concatenated class never reaches Tailwind's scanner.
//
// An element without classes gets no `class` key at all: imagex merges the
// attribute by splitting it on spaces and chokes on null.
$class        = $class ?? null;
$imgClass     = $imgClass ?? $class;
$pictureClass = $pictureClass ?? ($class ? $class . '-wrap' : null);

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
        'shared' => $pictureClass ? ['class' => $pictureClass] : [],
    ],
    'sourcesAttributes' => [
        'shared' => ['sizes' => $sizes],
    ],
]) ?>
