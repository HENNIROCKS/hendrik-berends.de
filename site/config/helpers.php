<?php

use Kirby\Cms\Page;

function isArticleLocked(Page $page): bool
{
    return $page->private()->toBool() && kirby()->session()->get('private-articles-unlocked') !== true;
}
