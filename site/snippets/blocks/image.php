<?php

use Kirby\Toolkit\Html;
use Kirby\Toolkit\Str;

/** 
 * @var \Kirby\Cms\Block $block 
 */

$alt     = $block->alt();
$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$link    = $block->link();
$ratio   = $block->ratio()->or('auto');
$image   = null;
$src     = null;

if ($block->location() == 'web') {
    $src = $block->src()->esc();
} elseif ($image = $block->image()->toFile()) {
    $alt = $alt->or($image->alt());
    $src = $image->url();
}

$lightboxHref = $image ? $image->url() : $src;

if ($src) {
    ob_start();

    if ($image) {
        snippet('partials/content-image', [
            'image' => $image,
            'alt' => $alt->value(),
            'sizes' => '100vw',
        ]);
    } else {
        ?><img alt="<?= $alt->esc() ?>" loading="lazy" src="<?= $src ?>"><?php
    }

    $imageMarkup = ob_get_clean();
}

?>

<?php if ($src): ?>
    <figure class="image" <?= Html::attr(['data-ratio' => $ratio, 'data-crop' => $crop], null, ' ') ?>>

        <?php if ($link->isNotEmpty()): ?>
            <a class="image__link" href="<?= Str::esc($link->toUrl()) ?>">
                <?= $imageMarkup ?>
            </a>
        <?php else: ?>
            <a data-fslightbox href="<?= $lightboxHref ?>">
                <?= $imageMarkup ?>
            </a>
        <?php endif ?>

        <?php if ($caption->isNotEmpty()): ?>
            <figcaption class="image__caption">
                <?= $caption ?>
            </figcaption>
        <?php endif ?>

    </figure>
<?php endif ?>