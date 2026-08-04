<?php

/**
 * 
 */

$url          = $article->url();
$title        = $article->title();
$previewImage = $article->previewimage()->toFile();
$firstImage   = $article->images()->first();

?>

<article class="article__preview">

    <a class="article__link" href="<?= $url ?>" aria-label="<?= esc($title) ?>"></a>

    <?php if ($image = $previewImage ?? $firstImage): ?>
        <?php snippet('partials/preview-image', ['image' => $image, 'alt' => $image->alt(), 'class' => 'article__image', 'critical' => $critical ?? false]) ?>
    <?php endif ?>

    <h3 class="article__title">
        <?= esc($title) ?>
    </h3>

</article>