<?php

use Kirby\Toolkit\Str;

/**
 * Renders the site's link collection as a list of sprite icons.
 *
 * @var \Kirby\Cms\Site $site
 * @var string|null $class Classes for the list element
 * @var string|null $itemClass Classes for each list item
 */

$class = $class ?? '';
$itemClass = $itemClass ?? '';

$allowedSchemes = ['http', 'https', 'mailto', 'tel'];

/**
 * A link's name comes from the Panel and ends up in the sprite reference, so
 * it is matched against the symbols that actually exist. An unknown name
 * renders the link without an icon; the visually hidden label carries it.
 */
$allowedIcons = [
  'behance', 'bluesky', 'cara', 'discord', 'feed', 'github', 'gitlab',
  'instagram', 'linkedin', 'mail', 'mastodon', 'paypal', 'pinterest',
  'pixelfed', 'reddit', 'signal', 'spotify', 'steam', 'xing', 'youtube',
];

?>

<ul<?= $class ? ' class="' . esc($class) . '"' : '' ?>>
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
    $icon = Str::lower($link->name());
    $icon = in_array($icon, $allowedIcons, true) ? $icon : null;
    ?>
    <li<?= $itemClass ? ' class="' . esc($itemClass) . '"' : '' ?>>
      <a href="<?= esc($link->url()) ?>" <?php if ($isExternal): ?> target="_blank" rel="<?= esc($rel) ?>" <?php endif ?> title="Weiter zu <?= esc($link->name()) ?>">
        <?php if ($icon): ?>
          <?php snippet('icon', ['name' => $icon]) ?>
        <?php endif ?>
        <span class="sr-only"><?= esc($link->name()) ?></span>
      </a>
    </li>
  <?php endforeach ?>
</ul>
