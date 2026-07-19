<?php

/**
 * @var \Kirby\Cms\Block $block
 */

$heading = $block->heading();
$domain  = $block->domain();
$name    = $block->name();
$text    = $block->button_text();
$tld     = $block->tld();

?>

<?php if ($domain->isNotEmpty() && $name->isNotEmpty() && $text->isNotEmpty() && $tld->isNotEmpty()) : ?>
    <div class="mailto">

        <?php if ($heading->isNotEmpty()): ?>
            <strong class="mailto__heading"><?= $heading ?></strong>
        <?php endif ?>

        <a class="mailto__link js-mailto-link"
            data-name="<?= $name ?>"
            data-domain="<?= $domain ?>"
            data-tld="<?= $tld ?>"
            href="#"
            title="E-Mail schreiben">

            <i class="mailto__icon mailto__icon--mail"></i>

            <?= $text ?>

        </a>

    </div>
<?php endif ?>