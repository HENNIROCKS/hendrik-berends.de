<?php

use Kirby\Toolkit\Escape;

/**
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Pages $articles
 *
 * Source:
 * https://getkirby.com/docs/cookbook/blog/feed
 */

?><?= '<?xml version="1.0" encoding="utf-8"?>' ?>

<rss version="2.0">
    <channel>
        <title><?= Escape::xml($site->title()) ?></title>
        <link><?= Escape::xml($site->url()) ?></link>
        <description><?= Escape::xml($site->description()->value()) ?></description>
        <language>de-DE</language>
        <lastBuildDate><?= date('r') ?></lastBuildDate>

        <?php foreach ($articles as $article): ?>
            <item>
                <title><?= Escape::xml($article->title()->value()) ?></title>
                <link><?= Escape::xml($article->url()) ?></link>
                <guid><?= Escape::xml($article->url()) ?></guid>
                <pubDate><?= date('r', $article->date()->toTimestamp()) ?></pubDate>
                <description><?= Escape::xml($article->description()->or($site->description())->value()) ?></description>
            </item>
        <?php endforeach ?>
    </channel>
</rss>
