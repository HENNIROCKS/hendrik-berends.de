<?php

use Kirby\Toolkit\Str;

/**
 * @var \Kirby\Cms\Page $page
 */

$headings = $page->layouts()->toBlocks()->filterBy('type', 'heading');

?>

<nav class="mb-xl" aria-label="Abschnitte dieser Seite">

    <strong class="mb-md block">Direkt zu:</strong>

    <ol class="mx-md mb-md">
        <?php foreach ($headings as $heading): ?>
            <?php
            $slug = Str::slug($heading->text());
            $text = Str::unhtml($heading->text());
            if (in_array($heading->level(), ['h2', 'h3', 'h4'])): ?>
                <li>
                    <a href="<?= $page->url() ?>#<?= $slug ?>" title="<?= esc('Direkt zum Abschnitt "' . $text . '"') ?>">
                        <?= $text ?>
                    </a>
                </li>
            <?php endif ?>
        <?php endforeach ?>
    </ol>

</nav>