<div class="articles articles--blog"<?php e(isset($id) && $id, ' id="' . $id . '"') ?>>

    <div class="articles__list articles__list--<?= $class ?>">
        <?php foreach ($articles as $article): ?>
            <?php snippet('blog/article', ['article' => $article]) ?>
        <?php endforeach ?>
    </div>

</div>