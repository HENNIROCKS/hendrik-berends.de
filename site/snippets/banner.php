<?php

/**
 * @var \Kirby\Cms\Site $site
 */

?>

<header class="container px-md pt-8 pb-md text-center font-bold tracking-[10px] uppercase md:pt-md md:text-3xl">

    <a href="<?= $site->url() ?>" title="Link zur Startseite">
        <?= esc($site->title()) ?>
    </a>

</header>