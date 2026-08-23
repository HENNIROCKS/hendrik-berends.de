<?php

use Kirby\Cms\Html;

/** 
 * @var \Kirby\Cms\Block $block
 */

$caption    = $block->caption();
$isInternal = $block->location() == 'kirby' && $block->video()->toFile();

if ($isInternal) {
    $video = $block->video()->toFile();
    $url   = $video->url();
    $attrs = array_filter([
        'autoplay'    => $block->autoplay()->toBool(),
        'controls'    => $block->controls()->toBool(),
        'loop'        => $block->loop()->toBool(),
        'muted'       => $block->muted()->toBool() || $block->autoplay()->toBool(),
        'playsinline' => $block->autoplay()->toBool(),
        'poster'      => $block->poster()->toFile()?->url(),
        'preload'     => $block->preload()->value(),
    ]);
    // Html::video() passes attributes straight to the tag, so the <video> can
    // be given utilities even though this block does not write its markup.
    // Set after array_filter, which would drop a falsy value.
    $attrs['class'] = 'block h-auto w-full';
    $videoHtml = Html::video($url, [], $attrs);
} else {
    $url       = $block->url();
    $videoHtml = null;
}
?>

<figure class="mb-xl">
    <?php if ($isInternal && $videoHtml): ?>
        <?= $videoHtml ?>
    <?php elseif (!$isInternal): ?>
        <div class="video-frame js-video relative aspect-video border border-border bg-[image:var(--pattern-doodle)]" data-video="<?= htmlspecialchars(Html::video($url)) ?>">
            <div class="absolute inset-0 m-auto h-fit text-center">
                <p>Beim Abspielen dieses Videos können Cookies durch den Anbieter (Vimeo, YouTube etc.) gesetzt werden.</p>
                <button class="inline-block cursor-pointer border border-background-inverse bg-background-inverse px-5 py-2.5 text-center font-display font-normal no-underline text-md text-foreground-inverse hover:border-link hover:bg-link focus:border-link focus:bg-link mt-md js-video-button" type="button">
                    <?php snippet('icon', ['name' => 'check']) ?>
                    Video laden und Cookies akzeptieren
                </button>
            </div>
        </div>
    <?php endif ?>

    <?php if ($caption->isNotEmpty()): ?>
        <figcaption class="prose mt-sm">
            <?= $caption ?>
        </figcaption>
    <?php endif ?>
</figure>