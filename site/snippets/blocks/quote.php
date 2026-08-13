<?php

/** @var \Kirby\Cms\Block $block */

$text     = $block->text();
$citation = $block->citation();

?>

<blockquote class="border-l-4 m-0 mb-(--spacing-large) pl-4">

  <span class="text-2xl">
    <?= $text ?>
  </span>

  <?php if ($citation->isNotEmpty()): ?>
    <footer class="before:content-['–'] mt-(--spacing-base)">
      <?= $citation ?>
    </footer>
  <?php endif ?>

</blockquote>