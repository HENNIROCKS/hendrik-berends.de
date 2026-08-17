<div class="flex items-center justify-between mb-md">

    <?php if ($page->hasPrevListed()): ?>
        <a href="<?= $page->prevListed()->url() ?>" title='Zur Seite <?= esc($page->prevListed()->title()) ?>'>
            <?php snippet('icon', ['name' => 'chevron-left', 'class' => 'icon--lg']) ?>
            <span class="sr-only">Vorherige Seite</span>
        </a>
    <?php else: ?>
        <span class="cursor-not-allowed opacity-50">
            <?php snippet('icon', ['name' => 'chevron-left', 'class' => 'icon--lg']) ?>
        </span>
    <?php endif ?>

    <?php if ($showDate == true): ?>
        <?= $page->date()->toDate('d. MMMM YYYY') ?>
    <?php elseif ($showTags == true): ?>
        <?= $page->tags()->toTags() ?>
    <?php endif ?>

    <?php if ($page->hasNextListed()): ?>
        <a href="<?= $page->nextListed()->url() ?>" title='Zur Seite <?= esc($page->nextListed()->title()) ?>'>
            <?php snippet('icon', ['name' => 'chevron-right', 'class' => 'icon--lg']) ?>
            <span class="sr-only">Nächste Seite</span>
        </a>
    <?php else: ?>
        <span class="cursor-not-allowed opacity-50">
            <?php snippet('icon', ['name' => 'chevron-right', 'class' => 'icon--lg']) ?>
        </span>
    <?php endif ?>

</div>