<?php

use Kirby\Toolkit\Str;

/**
 * @var Kirby\Cms\Page $page
 * @var bool $locked
 * @var bool $error
 */

?>

<?php snippet('document', slots: true) ?>
<?php slot() ?>

<?php if ($locked === false): ?>
  <?php snippet('schemas/schema-blogposting') ?>
<?php endif ?>

<main class="main main--<?= $page->template() ?> __container">
  <section class="section">
    <h1 class="mb-md text-center font-bold text-2xl" id="<?= Str::slug($page->title()) ?>">
      <?= esc($page->title()) ?>
    </h1>

    <?php if ($locked): ?>
      <?php snippet('blog/password-prompt', ['error' => $error]) ?>
    <?php else: ?>
      <?php snippet('prev-next', ['showDate' => true, 'showTags' => false]) ?>

      <hr class="mx-auto mb-xl h-0.5 w-xl border-0 bg-stone-500" />

      <?php snippet('tags/tags') ?>

      <?php snippet('layouts', ['layout_src' => $page->layouts()]) ?>
    <?php endif ?>
  </section>
</main>

<?php endslot() ?>
<?php endsnippet() ?>