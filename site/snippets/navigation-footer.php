<?php

/**
 * @var \Kirby\Cms\Site $site
 */

// The rule behind the menu is a ::before on the list, drawn only from md up
// where the items sit in a row. Each link paints the page background, which
// punches the rule out behind the labels so it reads as a single line running
// between them. Stacked below md there is no row for a line to follow, so the
// pseudo-element is never generated.
$rule = 'md:before:absolute md:before:inset-x-0 md:before:mx-auto '
    . 'md:before:mt-[calc((var(--spacing-lg)_-_2px)_*_-1)] '
    . 'md:before:h-0.5 md:before:w-xl md:before:bg-stone-400';

?>

<nav>

    <ul class="relative flex flex-col items-center gap-md md:flex-row md:items-baseline <?= $rule ?>">
        <?php foreach (collection('pages-footermenu') as $page): ?>
            <li>
                <a class="bg-background" href="<?= $page->url() ?>">
                    <?= esc($page->title()) ?>
                    <?php if ($page->hasChildren()) : ?>
                        <span class="rounded-xs bg-stone-300 px-0.75 text-stone-700">
                            <?= $page->children()->count() ?>
                        </span>
                    <?php endif ?>
                </a>
            </li>
        <?php endforeach ?>
    </ul>

</nav>
