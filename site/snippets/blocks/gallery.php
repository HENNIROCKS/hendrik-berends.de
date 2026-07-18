<?php

use Kirby\Toolkit\Html;

/** 
 * @var \Kirby\Cms\Block $block
 */

$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$ratio   = $block->ratio()->or('auto');

$variant = $block->variant();

?>

<?php if ($variant == '2col-masonry'): ?>
	<div class="gallery gallery--masonry">
		<?php
		$columns = [[], []];
		$counter = 0;
		foreach ($block->images()->toFiles() as $image) {
			$columns[$counter % 2][] = $image;
			$counter++;
		}
		?>
		<?php foreach ($columns as $column): ?>
			<div class="gallery__column">
				<?php foreach ($column as $image): ?>
					<a data-fslightbox href="<?= $image->url() ?>">
						<?= $image ?>
					</a>
				<?php endforeach ?>
			</div>
		<?php endforeach ?>
	</div>

<?php elseif ($variant == '3col-masonry'): ?>
	<div class="gallery gallery--masonry">
		<?php
		$columns = [[], [], []];
		$counter = 0;
		foreach ($block->images()->toFiles() as $image) {
			$columns[$counter % 3][] = $image;
			$counter++;
		}
		?>
		<?php foreach ($columns as $column): ?>
			<div class="gallery__column">
				<?php foreach ($column as $image): ?>
					<a data-fslightbox href="<?= $image->url() ?>">
						<?= $image ?>
					</a>
				<?php endforeach ?>
			</div>
		<?php endforeach ?>
	</div>

<?php elseif ($variant == 'scroll-horizontal'): ?>
	<div class="gallery gallery--scroll" <?= Html::attr(['data-crop' => $crop, 'data-ratio' => $ratio], null, ' ') ?>>
		<div class="gallery__container--outer">
			<i class="gallery__icon gallery__icon--arrow-left-right"></i>
			<div class="gallery__container--inner">
				<?php foreach ($block->images()->toFiles() as $image): ?>
					<a data-fslightbox href="<?= $image->url() ?>">
						<?= $image ?>
					</a>
				<?php endforeach ?>
			</div>
		</div>
		<?php if ($caption->isNotEmpty()): ?>
			<div class="gallery__caption">
				<?= $caption ?>
			</div>
		<?php endif ?>
	</div>

<?php else: ?>
	<div class="gallery gallery--none">
		<?php foreach ($block->images()->toFiles() as $image): ?>
			<a data-fslightbox href="<?= $image->url() ?>">
				<?= $image ?>
			</a>
		<?php endforeach ?>
		<?php if ($caption->isNotEmpty()): ?>
			<div class="gallery__caption">
				<?= $caption ?>
			</div>
		<?php endif ?>
	</div>
<?php endif ?>