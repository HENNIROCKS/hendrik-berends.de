<?php

/**
 * @var \Kirby\Cms\Site $site
 */

?>

<div class="scrolltop">
    <button aria-label="Nach oben scrollen" class="scrolltop__button" onclick="location.href='#top'" type="button">

        <span class="scrolltop__text">
            <?= $page->scrolltopText()->or("Nach oben scrollen") ?>
        </span>

    </button>
</div>