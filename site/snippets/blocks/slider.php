<?php

use Kirby\Toolkit\Html;

/**
 * @var \Kirby\Cms\Block $block
 */

$images = $block->images()->toFiles();

// The ratio drives three custom properties: the aspect ratio of the image
// itself, plus its two components separately, because the buttons derive
// the image height from the slide width and cannot do arithmetic on the
// combined value. Written out per option rather than interpolated — that
// keeps the values out of the markup and lets Tailwind see the classes,
// which it only does for literal strings. The default covers both a block
// saved before the field existed and anything the select never offered.
$ratio = match ($block->ratio()->value()) {
    '1/1' => '[--slider-ratio:1/1] [--slider-ratio-w:1] [--slider-ratio-h:1]',
    '16/9' => '[--slider-ratio:16/9] [--slider-ratio-w:16] [--slider-ratio-h:9]',
    '21/9' => '[--slider-ratio:21/9] [--slider-ratio-w:21] [--slider-ratio-h:9]',
    '7/5' => '[--slider-ratio:7/5] [--slider-ratio-w:7] [--slider-ratio-h:5]',
    '4/3' => '[--slider-ratio:4/3] [--slider-ratio-w:4] [--slider-ratio-h:3]',
    '5/3' => '[--slider-ratio:5/3] [--slider-ratio-w:5] [--slider-ratio-h:3]',
    '3/1' => '[--slider-ratio:3/1] [--slider-ratio-w:3] [--slider-ratio-h:1]',
    '2/3' => '[--slider-ratio:2/3] [--slider-ratio-w:2] [--slider-ratio-h:3]',
    default => '[--slider-ratio:3/2] [--slider-ratio-w:3] [--slider-ratio-h:2]',
};

// Missing on blocks saved before this field existed – those keep their
// current full-bleed appearance.
$fullWidth = $block->fullWidth()->isEmpty() ? true : $block->fullWidth()->toBool();

// Full-bleed breakout from the (centered) layout container. JS sets
// "--slider-bleed-left" (distance of the surrounding column to the
// viewport edge) and "--slider-width" (viewport width without the
// scrollbar), which keeps the breakout exact in off-center columns and
// avoids the scrollbar overshoot of a plain 100vw. The fallbacks are the
// classic centered-container math for the no-JS case, where "overflow-x:
// clip" on ".body" catches the scrollbar overshoot.
//
// The underscores in the fallback are load-bearing: Tailwind inserts the
// spaces a calc() needs around "-" by itself, but not inside a var()
// fallback – written as "(100vw-100%)" it reaches the browser unchanged
// and is invalid there.
$width = $fullWidth
    ? 'ml-[calc(-1*var(--slider-bleed-left,(100vw_-_100%)/2))] w-[var(--slider-width,100vw)]'
    : 'js-slider-contained w-full';

// Groups all images of this block into one lightbox gallery, without
// mixing them with other blocks on the same page.
$gallery = 'slider-' . $block->id();

$sizes = '(min-width: 1600px) 960px, (min-width: 1280px) 55vw, (min-width: 768px) 70vw, 85vw';

// Every fade in this block goes through this one duration, so reduced
// motion only has to be handled once.
$fade = '[--slider-fade:0.3s] motion-reduce:[--slider-fade:0s]';

// Sits on the outer edge of the (centered) active slide, and vertically
// centered on the image rather than on the slide – with a caption the
// slide is taller and the buttons would drift downwards.
$button = 'absolute top-[calc(var(--slider-slide-width)*var(--slider-ratio-h)/var(--slider-ratio-w)/2)] flex size-12 -translate-y-1/2 cursor-pointer items-center justify-center border-0 bg-background text-foreground hover:text-link focus:text-link [html:not(.js)_&]:hidden';

$total = $images->count();
$index = 0;

?>

<?php if ($total > 0): ?>
    <div class="js-slider mb-xl [--slider-slide-width:85vw] md:[--slider-slide-width:70vw] xl:[--slider-slide-width:min(55vw,60rem)] <?= $fade ?> <?= $ratio ?> <?= $width ?>">

        <div class="relative">
            <?php
            // "overflow-y: clip" is not redundant: without it the browser
            // promotes the other axis to "auto" as well, and the track
            // becomes vertically scrollable – a trackpad gesture then
            // shifts the images up and down inside their slide. The
            // padding lets the first and the last slide reach the center.
            ?>
            <div class="js-slider-track relative flex gap-md snap-x snap-mandatory overflow-x-auto overflow-y-clip px-[calc((100%-var(--slider-slide-width))/2)] scrollbar-none focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-focus [&::-webkit-scrollbar]:hidden" tabindex="0" role="group" aria-roledescription="Slider" aria-label="Bilderslider">
                <?php foreach ($images as $image): $index++ ?>
                    <?php $caption = $image->caption() ?>
                    <figure class="js-slider-slide flex-[0_0_var(--slider-slide-width)] snap-center [.js_&:not(.is-active)]:cursor-e-resize" role="group" aria-roledescription="Bild" aria-label="<?= $index ?> von <?= $total ?>">
                        <?php
                        // Only the active slide is fully lit. Tied to ".js"
                        // throughout: only then is a slide marked active, and
                        // only then does clicking a dimmed slide center it
                        // instead of opening the lightbox.
                        ?>
                        <a
                            class="js-lightbox slider-media block aspect-(--slider-ratio) h-full w-full transition-opacity duration-(--slider-fade) ease-[ease] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-focus [.js_.js-slider-slide:not(.is-active)_&]:opacity-40"
                            href="<?= $image->url() ?>"
                            aria-label="Bild <?= $index ?> von <?= $total ?> vergrößern"
                            data-gallery="<?= $gallery ?>"
                            <?= Html::attr(['data-description' => $caption->lightboxDescription()], null, ' ') ?>
                        >
                            <?php snippet('partials/content-image', [
                                'image' => $image,
                                'sizes' => $sizes,
                            ]) ?>
                        </a>

                        <?php if ($caption->isNotEmpty()): ?>
                            <?php
                            // Sits inside the slide, so it scrolls along with its
                            // image and keeps its space in the layout – hiding it
                            // with "display: none" would make the track height jump
                            // on every slide change. "visibility" follows only once
                            // the fade has finished, otherwise links inside an
                            // invisible caption would still be reachable via tab.
                            ?>
                            <figcaption class="prose mt-sm transition-opacity duration-(--slider-fade) ease-[ease] [.js_.js-slider-slide:not(.is-active)_&]:invisible [.js_.js-slider-slide:not(.is-active)_&]:opacity-0 [.js_.js-slider-slide:not(.is-active)_&]:[transition:opacity_var(--slider-fade)_ease,visibility_0s_var(--slider-fade)]">
                                <?= $caption ?>
                            </figcaption>
                        <?php endif ?>
                    </figure>
                <?php endforeach ?>
            </div>

            <?php
            // Without JS the buttons do nothing, so they are not rendered
            // as controls at all – see the "html:not(.js)" rule above.
            ?>
            <?php if ($total > 1): ?>
                <button class="js-slider-prev <?= $button ?> left-[calc(50%-var(--slider-slide-width)/2)]" type="button" aria-label="Vorheriges Bild">
                    <?php snippet('icon', ['name' => 'chevron-left']) ?>
                </button>
                <button class="js-slider-next <?= $button ?> right-[calc(50%-var(--slider-slide-width)/2)]" type="button" aria-label="Nächstes Bild">
                    <?php snippet('icon', ['name' => 'chevron-right']) ?>
                </button>
            <?php endif ?>
        </div>

    </div>
<?php endif ?>
