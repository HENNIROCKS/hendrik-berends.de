<?php

return [

    /**
     * https://getkirby.com/docs/cookbook/navigation/sitemap
     */

    [
        'pattern' => 'sitemap.xml',
        'action'  => function () {
            $pages = site()->pages()->index();

            // Fetch the pages to ignore from the config settings;
            // If nothing is set, we ignore the error page
            $ignore = kirby()->option('sitemap.ignore', ['error']);

            $content = snippet('sitemap', compact('pages', 'ignore'), true);

            return new Kirby\Cms\Response($content, 'application/xml');
        }
    ],
    [
        'pattern' => 'sitemap',
        'action'  => function () {
            return go('sitemap.xml', 301);
        }
    ],
    [
        'pattern' => 'llms.txt',
        'action'  => function () {
            $content = snippet('llms-txt', ['site' => site()], true);

            return new Kirby\Cms\Response($content, 'text/markdown');
        }
    ],
    [
        'pattern' => 'blog/feed.xml',
        'action'  => function () {
            $articles = collection('blog-articles')->limit(20);

            $content = snippet('feed', ['site' => site(), 'articles' => $articles], true);

            return new Kirby\Cms\Response($content, 'application/rss+xml');
        }
    ],
];
