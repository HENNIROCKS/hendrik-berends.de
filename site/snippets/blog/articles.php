<?php

/**
 * @var \Kirby\Cms\Pages $articles
 * @var bool $pinned Renders the highlighted list: wider columns, pushpin marker
 * @var string $id Anchor target, optional
 */

$pinned = $pinned ?? false;

// Both variants are spelled out in full instead of appending a column
// override to a shared base list: where two utilities set the same
// property, the CSS source order decides, not the order in the attribute.
$listClasses = $pinned
    ? 'mb-xl grid gap-y-md md:grid-cols-2 md:gap-x-md'
    : 'grid gap-y-md md:grid-cols-3 md:gap-x-md';

?>

<div class="text-center"<?php if (isset($id) && $id): ?> id="<?= $id ?>"<?php endif ?>>

    <div class="<?= $listClasses ?>">
        <?php $criticalCount = kirby()->option('preview-image.criticalCount', 6) ?>
        <?php $index = 0 ?>
        <?php foreach ($articles as $article): ?>
            <?php snippet('blog/article', [
                'article' => $article,
                'critical' => $index < $criticalCount,
                'pinned' => $pinned,
            ]) ?>
            <?php $index++ ?>
        <?php endforeach ?>
    </div>

</div>
