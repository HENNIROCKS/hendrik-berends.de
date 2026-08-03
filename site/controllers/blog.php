<?php

return function ($page) {

    $articles = collection('blog-articles');
    $tags     = $articles->pluck('tags', ',', true);

    if ($tag = param('tag')) {
        $tag      = urldecode($tag);
        $articles = $articles->filterBy('tags', $tag, ',');
    }

    sort($tags);

    $articles   = $articles->paginate(12, ['page' => param('page')]);
    $pagination = $articles->pagination();

    return compact('articles', 'tags', 'tag', 'pagination');
};
