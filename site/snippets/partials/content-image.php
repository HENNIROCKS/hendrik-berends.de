<?php

/**
 * @var \Kirby\Cms\File $image
 * @var string $alt
 * @var string|null $class
 * @var string $sizes
 */

$alt = $alt ?? $image->alt();

$imgShared = ['alt' => $alt, 'sizes' => $sizes];
$pictureShared = [];

if (isset($class)) {
    $imgShared['class'] = $class;
    $pictureShared['class'] = $class . '-wrap';
}

?>

<?php if (strtolower($image->extension()) === 'gif'): ?>
    <img alt="<?= esc($alt) ?>" loading="lazy" src="<?= $image->url() ?>" <?= isset($class) ? 'class="' . esc($class) . '"' : '' ?>>
<?php else: ?>
    <?php snippet('imagex-picture', [
        'image' => $image,
        'ratio' => 'intrinsic',
        'srcsetName' => 'content',
        'imgAttributes' => [
            'shared' => $imgShared,
        ],
        'pictureAttributes' => [
            'shared' => $pictureShared,
        ],
        'sourcesAttributes' => [
            'shared' => ['sizes' => $sizes],
        ],
    ]) ?>
<?php endif ?>
