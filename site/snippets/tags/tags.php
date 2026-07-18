<?php

/**
 * @var Kirby\Cms\Page $page
 * 
 * TODO:
 * - Make tags work and remove "disabled" option
 *   - Remove option passed to snippet in "templates/blog-article.php"
 *   - Remove styling for class "tags__link--disabled"
 */

?>

<div class="tags">
    <?php foreach ($page->tags()->split() as $tag): ?>

        <a class="tags__link" href="<?= $page->parent()->url(['params' => ['tag' => $tag]]) ?>" title="">
            <i class="tags__icon tags__icon--hashtag"></i>
            <?= $tag ?>
        </a>

    <?php endforeach ?>
</div>