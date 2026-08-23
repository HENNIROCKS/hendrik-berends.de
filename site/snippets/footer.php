<?php

/**
 * @var \Kirby\Cms\Site $site
 */

// The trailing colon is not a typo: Kirby only recognises a KirbyTag as
// "(name: value)", so a value-less tag still needs it. The text runs through
// kt() below, which is what expands it.
$text = $site->footertext()->or('Made with Kirby and (heart: ) &copy; ' . date('Y'));

?>

<footer>

    <div class="container mb-md flex flex-col items-center justify-between border-0 border-t border-dashed border-foreground md:mb-0 md:flex-row">
        <div class="flex flex-col items-center gap-sm py-md md:flex-row md:gap-md md:py-xl [&>p]:mb-0">
            <?php if ($text->isNotEmpty()) : ?>
                <?= $text->kt() ?>
            <?php endif ?>
            <?php snippet('website-carbon') ?>
        </div>

        <div class="flex flex-col items-center gap-md md:flex-row">
            <?php snippet('list-icons', ['class' => 'flex list-none gap-md']) ?>
        </div>
    </div>

    <div class="flex justify-center bg-[image:var(--pattern-japanese2)] bg-fixed py-lg md:py-2xl">
        <?php snippet('navigation-footer') ?>
    </div>

</footer>
