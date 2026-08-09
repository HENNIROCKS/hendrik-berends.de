<div class="articles articles--blog"<?php if (isset($id) && $id): ?> id="<?= $id ?>"<?php endif ?>>

    <div class="articles__list articles__list--<?= $class ?>">
        <?php $criticalCount = kirby()->option('preview-image.criticalCount', 6) ?>
        <?php $index = 0 ?>
        <?php foreach ($articles as $article): ?>
            <?php snippet('blog/article', ['article' => $article, 'critical' => $index < $criticalCount]) ?>
            <?php $index++ ?>
        <?php endforeach ?>
    </div>

</div>