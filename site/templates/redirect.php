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

<main class="main main--<?= $page->template() ?> __container">
    <section class="section">
        <h1 class="heading heading--h1"><?= $page->title() ?></h1>
    </section>
</main>

<?php endslot() ?>
<?php endsnippet() ?>
