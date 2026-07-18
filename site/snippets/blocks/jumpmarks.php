<?php

use Kirby\Toolkit\Str;

/**
 * @var \Kirby\Cms\Page $page
 */

$headings = $page->layouts()->toBlocks()->filterBy('type', 'heading');

?>

<nav class="jumpmarks">

    <strong class="jumpmarks__heading">Direkt zu:</strong>

    <ol class="jumpmarks__list">
        <?php foreach ($headings as $heading): ?>
            <?php
            $slug = Str::slug($heading->text());
            $text = Str::unhtml($heading->text());
            if (in_array($heading->level(), ['h2', 'h3', 'h4'])): ?>
                <li class="jumpmarks__list-item">
                    <a class="jumpmarks__link" href="<?= $page->url() ?>#<?= $slug ?>" title="<?= esc('Direkt zum Abschnitt "' . $text . '"') ?>">
                        <?= $text ?>
                    </a>
                </li>
            <?php endif ?>
        <?php endforeach ?>
    </ol>

</nav>