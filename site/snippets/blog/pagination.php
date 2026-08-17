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

    <div class="flex items-center justify-between my-2xl">

        <?php if ($pagination->hasPrevPage()): ?>
            <a href="<?= $pageURL($pagination->prevPage()) ?>" title="Vorherige Seite">
                <?php snippet('icon', ['name' => 'chevron-left', 'class' => 'icon--lg']) ?>
                <span class="sr-only">Vorherige Seite</span>
            </a>
        <?php else: ?>
            <span class="cursor-not-allowed opacity-50">
                <?php snippet('icon', ['name' => 'chevron-left', 'class' => 'icon--lg']) ?>
            </span>
        <?php endif ?>

        Seite <?= $pagination->page() ?> von <?= $pagination->pages() ?>

        <?php if ($pagination->hasNextPage()): ?>
            <a href="<?= $pageURL($pagination->nextPage()) ?>" title="Nächste Seite">
                <?php snippet('icon', ['name' => 'chevron-right', 'class' => 'icon--lg']) ?>
                <span class="sr-only">Nächste Seite</span>
            </a>
        <?php else: ?>
            <span class="cursor-not-allowed opacity-50">
                <?php snippet('icon', ['name' => 'chevron-right', 'class' => 'icon--lg']) ?>
            </span>
        <?php endif ?>

    </div>

<?php endif ?>
