<?php

/**
 * @var \Kirby\Cms\Site $site
 */

?>

<?php if ($site->stoerer()->isNotEmpty()): ?>
    <div class="stoerer">
        <?= $site->stoerer()->kt() ?>
    </div>
<?php endif ?>