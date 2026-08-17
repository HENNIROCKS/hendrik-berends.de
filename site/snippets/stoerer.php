<?php

/**
 * @var \Kirby\Cms\Site $site
 */

?>

<?php if ($site->stoerer()->isNotEmpty()): ?>
    <div class="prose fixed right-1.25 bottom-1.25 max-md:hidden rounded-sm bg-background-muted p-sm text-xs">
        <?= $site->stoerer()->kt() ?>
    </div>
<?php endif ?>