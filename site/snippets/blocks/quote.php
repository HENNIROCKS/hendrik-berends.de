<?php

/** @var \Kirby\Cms\Block $block */

$text     = $block->text();
$citation = $block->citation();

?>

<blockquote class="border-l-4 mb-xl pl-4">

  <span class="text-lg">
    <?= $text ?>
  </span>

  <?php if ($citation->isNotEmpty()): ?>
    <footer class="before:content-['–'] mt-md">
      <?= $citation ?>
    </footer>
  <?php endif ?>

</blockquote>