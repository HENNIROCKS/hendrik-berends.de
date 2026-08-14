<?php

/**
 * @var Kirby\Cms\Page $page
 */

$image = $page->images()->shuffle()->first();

?>

<?php if ($image): ?>
    <figure class="media mb-xl">
        <a href="<?= $page->url() ?>" title="Diese Seite neu laden">
            <img alt="Ein zufälliges GIF" loading="lazy" src="<?= $image->url() ?>">
        </a>
    </figure>
<?php endif ?>