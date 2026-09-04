<?php

/**
 * @var \Kirby\Cms\Site $site
 */

?>

<nav class="container mb-xl">

    <label class="block cursor-pointer text-center md:hidden" for="toggle-nav">
        <?php snippet('icon', ['name' => 'menu']) ?>
        <span class="sr-only">Menü auf- und zuklappen</span>
    </label>
    <input class="peer block appearance-none text-center md:hidden" id="toggle-nav" type="checkbox" />

    <ul class="mt-md border-0 border-y border-dashed border-foreground text-center max-md:hidden max-md:peer-checked:block md:mt-0 md:flex md:justify-evenly">
        <?php foreach (collection('pages-listed') as $page): ?>
            <?php $isOpen = $page->isOpen() ?>
            <li class="-my-px border-0 border-y border-foreground hover:border-solid hover:border-link <?= $isOpen ? 'border-solid' : 'border-dashed md:border-transparent' ?>">
                <a class="block px-xl py-md uppercase<?= $isOpen ? ' font-bold' : '' ?>" href="<?= $page->url() ?>">
                    <?= esc($page->title()) ?>
                </a>
            </li>
        <?php endforeach ?>
    </ul>

</nav>
