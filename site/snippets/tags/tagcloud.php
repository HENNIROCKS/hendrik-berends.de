<?php

use Kirby\Toolkit\Str;

/**
 * @var Kirby\Cms\Page $page
 * @var string $tags Comma-separated, from the blog controller
 */

// Three links share this base, so it stays in one place. Tailwind still sees
// the classes: the string is a literal in this file, which is all its scanner
// reads.
//
// text-md undoes the container's font-size: 0, which is there to swallow the
// whitespace between the inline-block links.
$link = 'mr-sm mb-sm inline-block border border-background-inverse '
    . 'bg-background-inverse px-0.75 text-md text-foreground-inverse no-underline '
    . 'hover:border-link hover:bg-link focus:border-link focus:bg-link';

?>

<div class="mb-[calc(var(--spacing-xl)_-_var(--spacing-md))] text-[0px]">

    <?php foreach (Str::split($tags) as $tag): ?>
        <a class="<?= $link ?><?php e(urlencode($tag) === param('tag'), ' border-link bg-link', '') ?>" href="<?= url($page->url(), ['params' => ['tag' => urlencode($tag)]]) ?>" title='Alle Artikel mit "<?= $tag ?>"'>
            <?php snippet('icon', ['name' => 'hashtag']) ?>
            <?= $tag ?>
        </a>
    <?php endforeach ?>

    <?php if ($tag = param('tag')): ?>
        <?php
        // The reset link is an outline: it undoes the fill and takes the
        // surrounding text colour, so it reads as secondary next to the tags.
        // Hover fills it like the others, which is why the inverse text colour
        // has to come back for that state.
        ?>
        <a class="<?= $link ?> bg-transparent text-inherit hover:text-foreground-inverse focus:text-foreground-inverse" href="<?= $page->url() ?>" title="Filter löschen">
            <?php snippet('icon', ['name' => 'close']) ?>
            Filter löschen
        </a>
    <?php endif ?>

</div>
