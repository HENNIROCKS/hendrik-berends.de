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
    <div class="mb-xl">

        <?php if ($heading->isNotEmpty()): ?>
            <strong class="mb-md block"><?= $heading ?></strong>
        <?php endif ?>

        <a class="inline-block cursor-pointer border border-background-inverse bg-background-inverse px-5 py-2.5 text-center font-display font-normal no-underline text-md text-foreground-inverse hover:border-link hover:bg-link focus:border-link focus:bg-link js-mailto-link"
            data-name="<?= $name ?>"
            data-domain="<?= $domain ?>"
            data-tld="<?= $tld ?>"
            href="#"
            title="E-Mail schreiben">

            <?php snippet('icon', ['name' => 'mail']) ?>

            <?= $text ?>

        </a>

    </div>
<?php endif ?>