<?php

use Kirby\Toolkit\Html;

/**
 * @var \Kirby\Cms\Block $block
 */

$images = $block->images()->toFiles();

// Only the fixed set of ratios from the blueprint is allowed here – the
// value is written into a custom property, so anything else would end up
// unescaped in a style attribute.
$ratio = $block->ratio()->value();

if (!is_string($ratio) || !preg_match('/^\d{1,2}\/\d{1,2}$/', $ratio)) {
    $ratio = '3/2';
}

// Width and height separately as well, so the CSS can derive the image
// height from the slide width – that is where the prev/next buttons sit,
// and the slide itself is taller when it carries a caption.
[$ratioWidth, $ratioHeight] = explode('/', $ratio);

// Missing on blocks saved before this field existed – those keep their
// current full-bleed appearance.
$fullWidth = $block->fullWidth()->isEmpty() ? true : $block->fullWidth()->toBool();

// Groups all images of this block into one lightbox gallery, without
// mixing them with other blocks on the same page.
$gallery = 'slider-' . $block->id();

$sizes = '(min-width: 1600px) 960px, (min-width: 1280px) 55vw, (min-width: 768px) 70vw, 85vw';

$total = $images->count();
$index = 0;

?>

<?php if ($total > 0): ?>
    <div class="slider js-slider<?= $fullWidth ? '' : ' slider--contained' ?>" style="--slider-ratio: <?= $ratio ?>; --slider-ratio-w: <?= $ratioWidth ?>; --slider-ratio-h: <?= $ratioHeight ?>">

        <div class="slider__viewport">
            <div class="slider__track js-slider-track" tabindex="0" role="group" aria-roledescription="Slider" aria-label="Bilderslider">
                <?php foreach ($images as $image): $index++ ?>
                    <?php $caption = $image->caption() ?>
                    <figure class="slider__slide js-slider-slide" role="group" aria-roledescription="Bild" aria-label="<?= $index ?> von <?= $total ?>">
                        <a
                            class="slider__link js-lightbox"
                            href="<?= $image->url() ?>"
                            aria-label="Bild <?= $index ?> von <?= $total ?> vergrößern"
                            data-gallery="<?= $gallery ?>"
                            <?= Html::attr(['data-description' => $caption->lightboxDescription()], null, ' ') ?>
                        >
                            <?php snippet('partials/content-image', [
                                'image' => $image,
                                'class' => 'slider__image',
                                'sizes' => $sizes,
                            ]) ?>
                        </a>

                        <?php if ($caption->isNotEmpty()): ?>
                            <figcaption class="slider__caption">
                                <?= $caption ?>
                            </figcaption>
                        <?php endif ?>
                    </figure>
                <?php endforeach ?>
            </div>

            <?php if ($total > 1): ?>
                <button class="slider__button slider__button--prev js-slider-prev" type="button" aria-label="Vorheriges Bild"></button>
                <button class="slider__button slider__button--next js-slider-next" type="button" aria-label="Nächstes Bild"></button>
            <?php endif ?>
        </div>

    </div>
<?php endif ?>
