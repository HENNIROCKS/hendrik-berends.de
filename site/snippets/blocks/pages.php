<?php

/**
 * @var \Kirby\Cms\Block $block
 */

?>

<div class="mb-xl flex flex-col items-center">
    <div class="grid gap-md md:grid-cols-2">

        <?php $criticalCount = kirby()->option('preview-image.criticalCount', 6) ?>
        <?php $index = 0 ?>
        <?php foreach ($block->pages()->toPages() as $article): ?>
            <?php
            // `media` carries the sizing and the loading fade for the imagex
            // picture/img pair, whose markup this block does not own.
            // `focus-within` rather than `focus`: the card itself is not
            // focusable, the overlay link inside it is.
            ?>
            <article class="media relative flex min-w-0 flex-col items-center justify-between rounded-md border border-foreground text-center hover:border-link hover:text-link focus-within:border-link focus-within:text-link">
                <a class="absolute h-full w-full" href="<?= $article->url() ?>" title="<?= esc($article->title()) ?>"></a>

                <?php if ($image = $article->previewimage()->toFile() ?? $article->images()->first()): ?>
                    <?php snippet('partials/preview-image', ['image' => $image, 'alt' => $article->title(), 'imgClass' => 'rounded-t-md', 'critical' => $index < $criticalCount]) ?>
                <?php endif ?>

                <span class="py-[1em]">
                    <?= $article->title() ?>
                </span>

            </article>
            <?php $index++ ?>
        <?php endforeach ?>

        <?php if ($block->pages()->toPages()->count() == 1): ?>
            <div class="rounded-md border border-dashed border-foreground max-md:hidden"></div>
        <?php endif ?>

    </div>
</div>