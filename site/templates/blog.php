<?php

use Kirby\Toolkit\Str;

/**
 * @var Kirby\Cms\Page $page
 */

?>

<?php snippet('document', slots: true) ?>
<?php slot() ?>

<main class="main main--<?= $page->template() ?>">
    <section class="section">
        <h1 class="heading heading--h1" id="<?= Str::slug($page->title()) ?>">
            <?= $page->title() ?>
        </h1>
        <hr class="line" />
        <div class="layouts">
            <?php if ($page->text()->isNotEmpty()): ?>
                <?php snippet('blocks/text', ['block' => $page]) ?>
            <?php endif ?>

            <?php snippet('tags/tagcloud') ?>

            <?php if ($page->pinned()->isNotEmpty() && !$tag = param('tag')): ?>
                <?php snippet('blog/articles', ['articles' => $page->pinned()->toPages(), 'class' => 'pinned']) ?>
            <?php endif ?>

            <?php snippet('blog/articles', ['articles' => $articles, 'class' => 'default', 'id' => 'artikel-liste']) ?>

            <?php snippet('blog/pagination', ['pagination' => $pagination, 'tag' => $tag]) ?>
        </div>
    </section>
</main>

<?php endslot() ?>
<?php endsnippet() ?>