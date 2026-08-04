<div class="articles articles--portfolio">
    <div class="articles__list">
        <?php $criticalCount = kirby()->option('preview-image.criticalCount', 6) ?>
        <?php $index = 0 ?>
        <?php foreach ($articles as $article): ?>
            <?php snippet('portfolio/article', ['article' => $article, 'critical' => $index < $criticalCount]) ?>
            <?php $index++ ?>
        <?php endforeach ?>
    </div>
</div>