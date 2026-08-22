<?php

/**
 * @var Kirby\Cms\Page $page
 *
 * TODO: Make tags work
 */

?>

<div class="mb-xl flex justify-center gap-md">
    <?php foreach ($page->tags()->split() as $tag): ?>

        <a class="flex items-center border border-background-inverse bg-background-inverse px-0.75 text-foreground-inverse no-underline hover:border-link hover:bg-link focus:border-link focus:bg-link" href="<?= $page->parent()->url(['params' => ['tag' => $tag]]) ?>">
            <?php snippet('icon', ['name' => 'hashtag']) ?>
            <?= esc($tag) ?>
        </a>

    <?php endforeach ?>
</div>
