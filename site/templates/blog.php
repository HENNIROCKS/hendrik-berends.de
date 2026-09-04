<?php

use Kirby\Toolkit\Str;

/**
 * @var Kirby\Cms\Page $page
 */

?>

<?php snippet('document', slots: true) ?>
<?php slot() ?>

<main>
    <section class="container mb-xl xl:mt-xl xl:max-w-[55vw]">
        <h1 class="mb-md text-center font-bold text-2xl" id="<?= Str::slug($page->title()) ?>">
            <?= $page->title() ?>
        </h1>
        <hr class="mx-auto mb-xl h-0.5 w-xl border-0 bg-stone-500" />
        <?php if ($page->text()->isNotEmpty()): ?>
            <?php snippet('blocks/text', ['block' => $page]) ?>
        <?php endif ?>

        <?php snippet('tags/tagcloud') ?>

        <?php if ($page->pinned()->isNotEmpty() && !$tag = param('tag')): ?>
            <?php snippet('blog/articles', ['articles' => $page->pinned()->toPages(), 'pinned' => true]) ?>
        <?php endif ?>

        <?php snippet('blog/articles', ['articles' => $articles, 'id' => 'artikel-liste']) ?>

        <?php snippet('blog/pagination', ['pagination' => $pagination, 'tag' => $tag]) ?>
    </section>
</main>

<?php endslot() ?>
<?php endsnippet() ?>