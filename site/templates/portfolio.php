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
        <h1 class="mb-md text-center font-bold text-2xl" id="<?= Str::slug($page->title()) ?>">
            <?= esc($page->title()) ?>
        </h1>
        <hr class="mx-auto mb-xl h-0.5 w-xl border-0 bg-stone-500" />
        <?php snippet('portfolio/articles', ['articles' => collection('portfolio-pages')]) ?>
    </section>
</main>

<?php endslot() ?>
<?php endsnippet() ?>