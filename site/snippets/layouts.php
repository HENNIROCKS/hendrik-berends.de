<?php

/**
 * @var Kirby\Cms\Page $page
 */

?>

<?php foreach ($page->layouts()->toLayouts() as $layout) : $columns = $layout->columns(); ?>
    <div class="layouts">
        <div class="layouts__columns layouts__columns--<?= $columns->count() ?>">

            <?php foreach ($columns as $column) : ?>
                <?php if (!$column->blocks()->isHidden()) : ?>
                    <div class="layouts__column layouts__column--<?= $column->span() ?>">
                        <?= $column->blocks() ?>
                    </div>
                <?php endif ?>
            <?php endforeach ?>

        </div>
    </div>
<?php endforeach ?>