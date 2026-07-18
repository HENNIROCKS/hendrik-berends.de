<?php

return function ($page) {

    // https://getkirby.com/docs/cookbook/content-representations/ajax-load-more

    // $limit    = 9;
    // $articles = collection('blog-articles')->paginate($limit);

    // return [
    //     'limit'      => $limit,
    //     'articles'   => $articles,
    //     'pagination' => $articles->pagination(),
    // ];

    $articles = collection('blog-articles');
    $tags     = $articles->pluck('tags', ',', true);

    if ($tag = param('tag')) {
        $tag      = urldecode($tag);
        $articles = $articles->filterBy('tags', $tag, ',');
    }

    sort($tags);

    $articles   = $articles->paginate(30); // TODO: Reduce limit and add pagination later
    $pagination = $articles->pagination();

    return compact('articles', 'tags', 'tag', 'pagination');
};
