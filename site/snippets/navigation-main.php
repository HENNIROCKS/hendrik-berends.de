<?php

/**
 * @var \Kirby\Cms\Site $site
 */

?>

<nav class="navigation navigation--main">

    <label class="navigation__label" for="toggle-nav">
        <i class="navigation__icon navigation__icon--menu"></i>
        <span class="sr-only">Menü auf- und zuklappen</span>
    </label>
    <input class="navigation__input" id="toggle-nav" type="checkbox" />

    <ul class="navigation__list">
        <?php foreach (collection('pages-listed') as $page): ?>
            <li class="navigation__list-item<?php e($page->isOpen(), ' navigation__list-item--active') ?>">
                <a class="navigation__link<?php e($page->isOpen(), ' navigation__link--active') ?>" href="<?= $page->url() ?>">
                    <?= esc($page->title()) ?>
                </a>
            </li>
        <?php endforeach ?>
    </ul>

</nav>