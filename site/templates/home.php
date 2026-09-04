<?php

/**
 * @var Kirby\Cms\Page $page
 * @var \Kirby\Cms\Site $site
 */

$textLeft   = $page->homeTextLeft();
$textRight  = $page->homeTextRight();
$textButton = $page->homeTextButton();

?>

<?php snippet('document', slots: true) ?>
<?php slot() ?>

<main class="flex flex-col items-center justify-center text-lg xl:h-screen xl:flex-row">
    <a class="hexagon-button absolute bg-background text-foreground" href="<?= $site->children()->listed()->first() ?>" title="Homepage betreten">
        <span class="relative"><?= esc($textButton->or("Eingang")) ?></span>
    </a>
    <div class="flex h-[50vh] w-full items-center justify-center bg-[image:var(--pattern-japanese2)] xl:h-full xl:w-[50vw]">
        <?php if ($textLeft->isNotEmpty()): ?>
            <div class="prose [&_p]:inline [&_p]:bg-background"><?= $textLeft->kt() ?></div>
        <?php else: ?>
            <?= esc($site->title()) ?>
        <?php endif ?>
    </div>
    <div class="flex h-[50vh] w-full items-center justify-center xl:h-full xl:w-[50vw]">
        <?php if ($textRight->isNotEmpty()): ?>
            <div class="prose w-[calc(100%-4*var(--spacing-md))] text-md md:w-1/2">
                <?= $textRight->kt() ?>
            </div>
        <?php else: ?>
            <?php snippet('list-icons', [
                'class' => 'flex flex-wrap list-none gap-md',
                'itemClass' => 'grow shrink-0 basis-1/4 text-center',
            ]) ?>
        <?php endif ?>
    </div>
</main>

<?php endslot() ?>
<?php endsnippet() ?>