<?php

use Kirby\Toolkit\Str;

/**
 * @var \Kirby\Cms\Site $site
 * @var string $class
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
    $isExternal = in_array($scheme, ['http', 'https'], true);
    $rel = null;
    if ($isExternal) {
      $relTokens = preg_split('/\s+/', strtolower(trim((string)$link->rel())), -1, PREG_SPLIT_NO_EMPTY);
      $rel = implode(' ', array_unique(array_merge(['noopener', 'noreferrer'], $relTokens)));
    }
    ?>
    <li class="<?= $class ?>__list-item">
      <a class="<?= $class ?>__link" href="<?= esc($link->url()) ?>" <?php if ($isExternal): ?> target="_blank" rel="<?= esc($rel) ?>" <?php endif ?> title="Weiter zu <?= esc($link->name()) ?>">
        <i class="<?= $class ?>__icon <?= $class ?>__icon--<?= Str::lower($link->name()) ?>"></i>
        <span class="sr-only"><?= esc($link->name()) ?></span>
      </a>
    </li>
  <?php endforeach ?>
</ul>