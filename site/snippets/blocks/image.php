<?php

use Kirby\Toolkit\Html;
use Kirby\Toolkit\Str;

/** 
 * @var \Kirby\Cms\Block $block 
 */

$alt     = $block->alt();
$caption = $block->caption();
$link    = $block->link();
$image   = null;
$src     = null;

if ($block->location() == 'web') {
    $src = $block->src()->esc();
} elseif ($image = $block->image()->toFile()) {
    $alt = $alt->or($image->alt());
    $src = $image->url();
}

$lightboxHref = $image ? $image->url() : $src;

// The image itself names the link whenever it has alt text. Only when it does
// not does the link need a name of its own — without one it is announced as
// its bare URL. The lightbox variant always carries a label, because "enlarge"
// is what the link does and no alt text expresses that.
$linkLabel = $alt->isNotEmpty() ? null : 'Verlinktes Bild';

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
    <figure class="media mb-xl">

        <?php if ($link->isNotEmpty()): ?>
            <a href="<?= Str::esc($link->toUrl()) ?>" <?= Html::attr(['aria-label' => $linkLabel], null, ' ') ?>>
                <?= $imageMarkup ?>
            </a>
        <?php else: ?>
            <a class="js-lightbox" href="<?= $lightboxHref ?>" aria-label="Bild vergrößern" data-gallery="image-<?= $block->id() ?>" <?= Html::attr(['data-description' => $caption->lightboxDescription()], null, ' ') ?>>
                <?= $imageMarkup ?>
            </a>
        <?php endif ?>

        <?php if ($caption->isNotEmpty()): ?>
            <figcaption class="prose mt-sm">
                <?= $caption ?>
            </figcaption>
        <?php endif ?>

    </figure>
<?php endif ?>