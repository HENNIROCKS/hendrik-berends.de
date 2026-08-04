<?php

/**
 * @var \Kirby\Cms\Block $block
 */

?>

<div class="pages">
    <div class="pages__articles">

        <?php $criticalCount = kirby()->option('preview-image.criticalCount', 6) ?>
        <?php $index = 0 ?>
        <?php foreach ($block->pages()->toPages() as $article): ?>
            <article class="pages__article">
                <a class="pages__link" href="<?= $article->url() ?>" title="<?= esc($article->title()) ?>"></a>

                <?php if ($image = $article->previewimage()->toFile() ?? $article->images()->first()): ?>
                    <?php snippet('partials/preview-image', ['image' => $image, 'alt' => $article->title(), 'class' => 'pages__image', 'critical' => $index < $criticalCount]) ?>
                <?php endif ?>

                <span class="pages__title">
                    <?= $article->title() ?>
                </span>

            </article>
            <?php $index++ ?>
        <?php endforeach ?>

        <?php if ($block->pages()->toPages()->count() == 1): ?>
            <div class="pages__article--placeholder"></div>
        <?php endif ?>

    </div>
</div>