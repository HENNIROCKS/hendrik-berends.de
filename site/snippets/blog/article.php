<?php

/**
 * 
 */

$short        = $article->short()->toBool();
$url          = $article->url();
$title        = $article->title();
$previewImage = $article->previewimage()->toFile();
$firstImage   = $article->images()->first();
$date         = $article->date();

?>

<article class="article__preview<?php e($short === true, ' article__preview--short') ?>">

    <a class="article__link" href="<?= $url ?>" aria-label="<?= esc($title) ?>"></a>

    <?php if ($image = $previewImage ?? $firstImage): ?>
        <?php snippet('partials/preview-image', ['image' => $image, 'alt' => $image->alt(), 'class' => 'article__image', 'critical' => $critical ?? false]) ?>
    <?php endif ?>

    <h3 class="article__title">
        <?= esc($title) ?>

        <time class="article__date" datetime="<?= $date->toDate('YYYY-MM-dd') ?>">
            <?= $date->toDate('d. MMMM YYYY') ?>
        </time>
    </h3>

</article>