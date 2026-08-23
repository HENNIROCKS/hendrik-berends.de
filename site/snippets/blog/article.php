<?php

/**
 * @var \Kirby\Cms\Page $article
 * @var bool $critical
 * @var bool $pinned Adds the pushpin marker
 */

$short        = $article->short()->toBool();
$private      = $article->private()->toBool();
$url          = $article->url();
$title        = $article->title();
$previewImage = $article->previewimage()->toFile();
$firstImage   = $article->images()->first();
$date         = $article->date();

// `media` carries the sizing and the loading fade for the imagex
// picture/img pair, whose markup this snippet does not own.
// `focus-within` rather than `focus`: the card itself is not focusable,
// the overlay link inside it is.
?>

<article class="media relative flex min-w-0 flex-col items-center justify-between rounded-md border border-foreground hover:border-link hover:text-link focus-within:border-link focus-within:text-link<?php e($short === true, " before:content-['…']") ?>">

    <a class="absolute left-0 right-0 h-full w-full" href="<?= $url ?>" aria-label="<?= esc($title) ?>"></a>

    <?php if ($pinned ?? false): ?>
        <span class="absolute right-[1em] top-[1em] rounded-full bg-white p-[5px] text-black">
            <?php snippet('icon', ['name' => 'pushpin', 'class' => 'icon--lg']) ?>
        </span>
    <?php endif ?>

    <?php if ($private): ?>
        <span class="absolute right-[1em] top-[1em] z-1 rounded-md bg-white px-[0.75em] py-[0.25em] font-bold text-black text-sm">🔒 Privat</span>
    <?php endif ?>

    <?php if ($image = $previewImage ?? $firstImage): ?>
        <?php snippet('partials/preview-image', [
            'image' => $image,
            'alt' => $image->alt(),
            'imgClass' => 'rounded-t-md',
            'critical' => $critical ?? false,
            'srcsetName' => $private ? 'preview-private' : 'preview',
        ]) ?>
    <?php endif ?>

    <h3 class="py-md font-bold">
        <?= esc($title) ?>

        <time class="block font-normal text-sm" datetime="<?= $date->toDate('YYYY-MM-dd') ?>">
            <?= $date->toDate('d. MMMM YYYY') ?>
        </time>
    </h3>

</article>
