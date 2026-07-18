<?php

// use Kirby\Toolkit\I18n;

/**
 * @var \Kirby\Cms\Site $site
 */

?>

<nav class="navigation navigation--footer">

    <ul class="navigation__list">
        <?php foreach (collection('pages-footermenu') as $page): ?>
            <li class="navigation__list-item<?php e($page->isOpen(), ' navigation__list-item--active') ?>">
                <a class="navigation__link<?php e($page->isOpen(), ' navigation__link--active') ?>" href="<?= $page->url() ?>" title="<?php /* echo I18n::template('link.title.topage', null, ['page' => $page->title()]) */ ?>">
                    <?= $page->title() ?>
                    <?php if ($page->hasChildren()) : ?>
                        <span class="navigation__badge">
                            <?= $page->children()->count() ?>
                        </span>
                    <?php endif ?>
                </a>
            </li>
        <?php endforeach ?>
    </ul>

</nav>