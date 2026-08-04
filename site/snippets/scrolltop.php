<?php

/**
 * @var \Kirby\Cms\Site $site
 */

?>

<div class="scrolltop">
    <button aria-label="Nach oben scrollen" class="scrolltop__button js-scrolltop-button" type="button">

        <span class="scrolltop__text">
            <?= esc($page->scrolltopText()->or("Nach oben scrollen")) ?>
        </span>

    </button>
</div>