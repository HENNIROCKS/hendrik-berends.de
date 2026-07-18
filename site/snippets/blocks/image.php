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
$src     = null;

if ($block->location() == 'web') {
    $src = $block->src()->esc();
} elseif ($image = $block->image()->toFile()) {
    $alt = $alt->or($image->alt());
    $src = $image->url();
}

?>

<?php if ($src): ?>
    <figure class="image" <?= Html::attr(['data-ratio' => $ratio, 'data-crop' => $crop], null, ' ') ?>>

        <?php if ($link->isNotEmpty()): ?>
            <a class="image__link" href="<?= Str::esc($link->toUrl()) ?>">
                <img alt="<?= $alt->esc() ?>" src="<?= $src ?>">
            </a>
        <?php else: ?>
            <a data-fslightbox href="<?= $image->url() ?>">
                <img alt="<?= $alt->esc() ?>" src="<?= $src ?>">
            </a>
        <?php endif ?>

        <?php if ($caption->isNotEmpty()): ?>
            <figcaption class="image__caption">
                <?= $caption ?>
            </figcaption>
        <?php endif ?>

    </figure>
<?php endif ?>