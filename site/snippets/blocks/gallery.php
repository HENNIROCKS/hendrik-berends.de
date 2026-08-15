<?php

use Kirby\Toolkit\Html;

/**
 * @var \Kirby\Cms\Block $block
 */

$caption = $block->caption();

$variant = $block->variant();

// Groups all images of this block into one lightbox gallery, without
// mixing them with other blocks on the same page.
$gallery = 'gallery-' . $block->id();

// https://piccalil.li/blog/a-simple-masonry-like-composable-layout/
// The columns share a row until the container falls below 28rem, at which
// point the flex-basis flips to an absurd value and each one takes a row of
// its own. Written out rather than kept behind a custom property: there is
// exactly one consumer.
$column = 'grow basis-[calc((28rem_-_100%)_*_999)] text-md';

?>

<?php if ($variant == '2col-masonry'): ?>
	<div class="media mx-auto mb-xl flex max-w-7xl flex-wrap items-start bg-background-muted text-[0px]">
		<?php
		$columns = [[], []];
		$counter = 0;
		foreach ($block->images()->toFiles() as $image) {
			$columns[$counter % 2][] = $image;
			$counter++;
		}
		?>
		<?php foreach ($columns as $column_images): ?>
			<div class="<?= $column ?>">
				<?php foreach ($column_images as $image): ?>
					<a class="js-lightbox" href="<?= $image->url() ?>" data-gallery="<?= $gallery ?>" <?= Html::attr(['data-description' => $image->caption()->lightboxDescription()], null, ' ') ?>>
						<?php snippet('partials/content-image', ['image' => $image, 'sizes' => '(min-width: 1280px) 640px, (min-width: 448px) 50vw, 100vw']) ?>
					</a>
				<?php endforeach ?>
			</div>
		<?php endforeach ?>
	</div>

<?php elseif ($variant == '3col-masonry'): ?>
	<div class="media mx-auto mb-xl flex max-w-7xl flex-wrap items-start bg-background-muted text-[0px]">
		<?php
		$columns = [[], [], []];
		$counter = 0;
		foreach ($block->images()->toFiles() as $image) {
			$columns[$counter % 3][] = $image;
			$counter++;
		}
		?>
		<?php foreach ($columns as $column_images): ?>
			<div class="<?= $column ?>">
				<?php foreach ($column_images as $image): ?>
					<a class="js-lightbox" href="<?= $image->url() ?>" data-gallery="<?= $gallery ?>" <?= Html::attr(['data-description' => $image->caption()->lightboxDescription()], null, ' ') ?>>
						<?php snippet('partials/content-image', ['image' => $image, 'sizes' => '(min-width: 1280px) 426px, (min-width: 448px) 33vw, 100vw']) ?>
					</a>
				<?php endforeach ?>
			</div>
		<?php endforeach ?>
	</div>

<?php elseif ($variant == 'scroll-horizontal'): ?>
	<div class="mb-xl grid overflow-hidden">
		<div class="relative bg-background-muted">
			<?php
			// No horizontal offset on purpose: the hint stays where the flow
			// would have put it, at the left edge of the strip, and is only
			// centred vertically. It precedes the scroll container in the
			// markup, so being positioned is enough to paint it on top.
			?>
			<span class="absolute inset-y-0 my-auto flex size-12 items-center justify-center bg-background">
				<?php snippet('icon', ['name' => 'arrow-left-right']) ?>
			</span>
			<div class="filmstrip overflow-auto p-md text-[0px] whitespace-nowrap xl:max-w-[calc(55vw_-_calc(var(--spacing-md)_*_2))]">
				<?php foreach ($block->images()->toFiles() as $image): ?>
					<a class="js-lightbox" href="<?= $image->url() ?>" data-gallery="<?= $gallery ?>" <?= Html::attr(['data-description' => $image->caption()->lightboxDescription()], null, ' ') ?>>
						<?php snippet('partials/content-image', ['image' => $image, 'sizes' => '(min-width: 1280px) 55vw, 100vw']) ?>
					</a>
				<?php endforeach ?>
			</div>
		</div>
		<?php if ($caption->isNotEmpty()): ?>
			<div class="prose mt-sm">
				<?= $caption ?>
			</div>
		<?php endif ?>
	</div>

<?php else: ?>
	<div class="media mb-xl">
		<?php foreach ($block->images()->toFiles() as $image): ?>
			<a class="js-lightbox" href="<?= $image->url() ?>" data-gallery="<?= $gallery ?>" <?= Html::attr(['data-description' => $image->caption()->lightboxDescription()], null, ' ') ?>>
				<?php snippet('partials/content-image', ['image' => $image, 'sizes' => '100vw']) ?>
			</a>
		<?php endforeach ?>
		<?php if ($caption->isNotEmpty()): ?>
			<div class="prose mt-sm">
				<?= $caption ?>
			</div>
		<?php endif ?>
	</div>
<?php endif ?>
