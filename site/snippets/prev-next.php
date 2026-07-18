<div class="prev-next">

    <?php if ($page->hasPrevListed()): ?>
        <a class="prev-next__link" href="<?= $page->prevListed()->url() ?>" title='Zur Seite <?= $page->prevListed()->title() ?>'>
            <i class="prev-next__icon prev-next__icon--chevron-left"></i>
            <span class="sr-only">Vorherige Seite</span>
        </a>
    <?php else: ?>
        <span class="prev-next__placeholder">
            <i class="prev-next__icon prev-next__icon--chevron-left"></i>
        </span>
    <?php endif ?>

    <?php if ($showDate == true): ?>
        <?= $page->date()->toDate('d. MMMM YYYY') ?>
    <?php elseif ($showTags == true): ?>
        <?= $page->tags()->toTags() ?>
    <?php else: ?>
        <!-- <span>Blättern</span> -->
    <?php endif ?>

    <?php if ($page->hasNextListed()): ?>
        <a class="prev-next__link" href="<?= $page->nextListed()->url() ?>" title='Zur Seite <?= $page->nextListed()->title() ?>'>
            <i class="prev-next__icon prev-next__icon--chevron-right"></i>
            <span class="sr-only">Nächste Seite</span>
        </a>
    <?php else: ?>
        <span class="prev-next__placeholder">
            <i class="prev-next__icon prev-next__icon--chevron-right"></i>
        </span>
    <?php endif ?>

</div>