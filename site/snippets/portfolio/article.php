<?php

/**
 * @var \Kirby\Cms\Page $article
 * @var bool $critical
 */

$url          = $article->url();
$title        = $article->title();
$previewImage = $article->previewimage()->toFile();
$firstImage   = $article->images()->first();

// See blog/article.php for the `media` and `focus-within` rationale.
?>

<article class="media relative flex min-w-0 flex-col items-center justify-between rounded-md border border-foreground hover:border-link hover:text-link focus-within:border-link focus-within:text-link">

    <a class="absolute left-0 right-0 h-full w-full" href="<?= $url ?>" aria-label="<?= esc($title) ?>"></a>

    <?php if ($image = $previewImage ?? $firstImage): ?>
        <?php snippet('partials/preview-image', ['image' => $image, 'alt' => $image->alt(), 'imgClass' => 'rounded-t-md', 'critical' => $critical ?? false]) ?>
    <?php endif ?>

    <h3 class="py-md font-bold">
        <?= esc($title) ?>
    </h3>

</article>
