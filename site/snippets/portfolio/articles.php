<div class="articles articles--portfolio">
    <div class="articles__list">
        <?php foreach ($articles as $article): ?>
            <?php snippet('portfolio/article', ['article' => $article]) ?>
        <?php endforeach ?>
    </div>
</div>