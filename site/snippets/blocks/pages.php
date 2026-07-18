<?php

/**
 * @var \Kirby\Cms\Block $block
 */

?>

<div class="pages">
    <div class="pages__articles">

        <?php foreach ($block->pages()->toPages() as $article): ?>
            <article class="pages__article">
                <a class="pages__link" href="<?= $article->url() ?>" title="<?= esc($article->title()) ?>"></a>

                <?php if ($image = $article->previewimage()->toFile() ?? $article->images()->first()): ?>
                    <img alt="<?= esc($article->title()) ?>" class="pages__image" src="<?= $image->crop(640, 250, 80)->url() ?>" />
                <?php endif ?>

                <span class="pages__title">
                    <?= $article->title() ?>
                </span>

            </article>
        <?php endforeach ?>

        <?php if ($block->pages()->toPages()->count() == 1): ?>
            <div class="pages__article--placeholder"></div>
        <?php endif ?>

    </div>
</div>