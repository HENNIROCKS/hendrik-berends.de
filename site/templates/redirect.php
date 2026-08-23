<?php

/**
 * @var Kirby\Cms\Page $page
 */

if ($target = $page->redirect()->toPage()) {
    go($target->url(), 301);
}

?>

<?php snippet('document', slots: true) ?>
<?php slot() ?>

<main>
    <section class="section">
        <h1 class="mb-md text-center font-bold text-2xl"><?= $page->title() ?></h1>
    </section>
</main>

<?php endslot() ?>
<?php endsnippet() ?>
