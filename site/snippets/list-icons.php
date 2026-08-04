<?php

use Kirby\Toolkit\Str;

/**
 * @var \Kirby\Cms\Site $site
 */

$allowedSchemes = ['http', 'https', 'mailto', 'tel'];

?>

<ul class="<?= $class ?>__list <?= $class ?>__list--icons">
    <?php foreach (collection('links') as $link): ?>
        <?php
        $scheme = strtolower((string)parse_url($link->url()->value(), PHP_URL_SCHEME));
        if ($link->display()->toBool() !== true || in_array($scheme, $allowedSchemes, true) === false) {
            continue;
        }
        $rel = trim('noopener noreferrer ' . $link->rel());
        ?>
        <li class="<?= $class ?>__list-item">
            <a class="<?= $class ?>__link" href="<?= esc($link->url()) ?>" rel="<?= esc($rel) ?>" target="_blank" title="Weiter zu <?= esc($link->name()) ?>">
                <i class="<?= $class ?>__icon <?= $class ?>__icon--<?= Str::lower($link->name()) ?>"></i>
                <span class="sr-only"><?= esc($link->name()) ?></span>
            </a>
        </li>
    <?php endforeach ?>
</ul>