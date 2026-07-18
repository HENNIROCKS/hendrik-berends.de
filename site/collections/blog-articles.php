<?php

/**
 * @var \Kirby\Cms\Site $site
 */

return function ($site) {
    return $site->pages()->filterBy('intendedTemplate', 'blog')->children()->listed()->sortBy(
        fn($page) => $page->date()->toDate(),
        'desc'
    );
};
