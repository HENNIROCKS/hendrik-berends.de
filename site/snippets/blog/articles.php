<div class="articles articles--blog">

    <div class="articles__list articles__list--<?= $class ?><?php e($ajax, ' js-articles') ?>" data-page="<?= $pagination->nextPage() ?>">
        <?php foreach ($articles as $article): ?>
            <?php snippet('blog/article', ['article' => $article]) ?>
        <?php endforeach ?>
    </div>

    <?php if ($ajax == true): ?>
        <button accesskey="m" class="articles__button js-more">
            Mehr laden
        </button>
    <?php endif ?>

</div>