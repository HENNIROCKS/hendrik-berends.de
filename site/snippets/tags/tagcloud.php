<?php

use Kirby\Toolkit\Str;

?>

<div class="tagcloud">

    <?php foreach (Str::split($tags) as $tag): ?>
        <a class="tagcloud__link<?php e(urlencode($tag) === param('tag'), ' tagcloud__link--active', '') ?>" href="<?= url($page->url(), ['params' => ['tag' => urlencode($tag)]]) ?>" title='Alle Artikel mit "<?= $tag ?>"'>
            <i class="tagcloud__icon tagcloud__icon--hashtag"></i>
            <?= $tag ?>
        </a>
    <?php endforeach ?>

    <?php if ($tag = param('tag')): ?>
        <a class="tagcloud__link tagcloud__link--reset" href="<?= $page->url() ?>" title="Filter löschen">
            <i class="tagcloud__icon tagcloud__icon--close"></i>
            Filter löschen
        </a>
    <?php endif ?>

</div>