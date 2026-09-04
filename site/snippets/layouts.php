<?php

/**
 * @var Kirby\Cms\Page $page
 */

?>

<?php foreach ($page->layouts()->toLayouts() as $layout) : ?>
    <div class="grid grid-cols-12 md:gap-x-lg">

        <?php foreach ($layout->columns() as $column) : ?>
            <?php if (!$column->blocks()->isHidden()) : ?>
                <?php
                $span = match ((int) $column->span()) {
                    3 => 'col-span-12 md:col-span-6 lg:col-span-3',   // 1/4
                    4 => 'col-span-12 md:col-span-6 lg:col-span-4',   // 1/3
                    6 => 'col-span-12 md:col-span-6',                 // 1/2
                    8 => 'col-span-12 md:col-span-6 lg:col-span-8',   // 2/3
                    default => 'col-span-12',                         // 1/1
                };

                /**
                 * Without `min-w-0` the column keeps its automatic minimum
                 * size and cannot be squeezed into its grid track. A
                 * full-bleed element (the slider) would then spill out of
                 * the column and over its neighbours.
                 */
                ?>
                <div class="flex min-w-0 flex-col <?= $span ?>">
                    <?= $column->blocks() ?>
                </div>
            <?php endif ?>
        <?php endforeach ?>

    </div>
<?php endforeach ?>
