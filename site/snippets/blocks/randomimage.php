<?php

/**
 * @var Kirby\Cms\Page $page
 */

$image = $page->images()->shuffle()->first();

?>

<?php if ($image): ?>
    <figure class="image">
        <a class="image__link" href="<?= $page->url() ?>" title="Diese Seite neu laden">
            <img alt="Ein zufälliges GIF" src="<?= $image->url() ?>">
        </a>
    </figure>
<?php endif ?>