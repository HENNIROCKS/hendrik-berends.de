<?php

/**
 * @var \Kirby\Cms\Pages $articles
 */

?>

<div class="text-center">
    <div class="grid gap-y-md md:grid-cols-3 md:gap-x-md">
        <?php $criticalCount = kirby()->option('preview-image.criticalCount', 6) ?>
        <?php $index = 0 ?>
        <?php foreach ($articles as $article): ?>
            <?php snippet('portfolio/article', ['article' => $article, 'critical' => $index < $criticalCount]) ?>
            <?php $index++ ?>
        <?php endforeach ?>
    </div>
</div>
