<?php

/**
 * @var \Kirby\Cms\Page $page
 */

?>

<div class="my-xl text-center">
    <button aria-label="Nach oben scrollen" class="hexagon-button relative bg-background-muted text-foreground js-scrolltop-button" type="button">

        <span class="relative">
            <?= esc($page->scrolltopText()->or("Nach oben scrollen")) ?>
        </span>

    </button>
</div>
