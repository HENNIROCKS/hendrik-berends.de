<?php

/**
 * @var \Kirby\Cms\File $image
 * @var string $alt
 * @var string $class
 * @var bool $critical
 */

$sizes = '(min-width: 768px) 33vw, 100vw';

?>

<?php snippet('imagex-picture', [
    'image' => $image,
    'ratio' => '640/250',
    'srcsetName' => 'preview',
    'critical' => $critical ?? false,
    'imgAttributes' => [
        'shared' => [
            'alt' => $alt,
            'class' => $class,
            'sizes' => $sizes,
        ],
    ],
    'pictureAttributes' => [
        'shared' => ['class' => $class . '-wrap'],
    ],
    'sourcesAttributes' => [
        'shared' => ['sizes' => $sizes],
    ],
]) ?>
