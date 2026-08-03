<?php if ($pagination->hasPages()): ?>

    <?php
    $pageURL = fn ($number) => url($page->url(), [
        'params' => array_filter([
            'tag'  => $tag ? urlencode($tag) : null,
            'page' => $number > 1 ? $number : null,
        ]),
        'fragment' => 'artikel-liste',
    ]);
    ?>

    <div class="prev-next prev-next--pagination">

        <?php if ($pagination->hasPrevPage()): ?>
            <a class="prev-next__link" href="<?= $pageURL($pagination->prevPage()) ?>" title="Vorherige Seite">
                <i class="prev-next__icon prev-next__icon--chevron-left"></i>
                <span class="sr-only">Vorherige Seite</span>
            </a>
        <?php else: ?>
            <span class="prev-next__placeholder">
                <i class="prev-next__icon prev-next__icon--chevron-left"></i>
            </span>
        <?php endif ?>

        Seite <?= $pagination->page() ?> von <?= $pagination->pages() ?>

        <?php if ($pagination->hasNextPage()): ?>
            <a class="prev-next__link" href="<?= $pageURL($pagination->nextPage()) ?>" title="Nächste Seite">
                <i class="prev-next__icon prev-next__icon--chevron-right"></i>
                <span class="sr-only">Nächste Seite</span>
            </a>
        <?php else: ?>
            <span class="prev-next__placeholder">
                <i class="prev-next__icon prev-next__icon--chevron-right"></i>
            </span>
        <?php endif ?>

    </div>

<?php endif ?>
