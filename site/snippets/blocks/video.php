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
    $videoHtml = Html::video($url, [], $attrs ?? []);
} else {
    $url       = $block->url();
    $videoHtml = null;
}
?>

<figure class="video">
    <?php if ($isInternal && $videoHtml): ?>
        <?= $videoHtml ?>
    <?php elseif (!$isInternal): ?>
        <div class="video__container js-video" data-video="<?= htmlspecialchars(Html::video($url)) ?>">
            <div class="video__placeholder">
                <p>Beim Abspielen dieses Videos können Cookies durch den Anbieter (Vimeo, YouTube etc.) gesetzt werden.</p>
                <button class="video__button js-video-button" type="button">
                    <i class="video__icon video__icon--check"></i>
                    Video laden und Cookies akzeptieren
                </button>
            </div>
        </div>
    <?php endif ?>

    <?php if ($caption->isNotEmpty()): ?>
        <figcaption class="video__caption">
            <?= $caption ?>
        </figcaption>
    <?php endif ?>
</figure>