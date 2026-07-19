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
        <img alt="<?= esc($image->alt()) ?>" class="article__image" src="<?= $image->crop(640, 250, 80)->url() ?>" />
    <?php endif ?>

    <h3 class="article__title">
        <?= esc($title) ?>
    </h3>

</article>