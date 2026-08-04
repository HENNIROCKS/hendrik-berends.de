<?php

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
        <title><?= html($site->title()) ?></title>
        <link><?= html($site->url()) ?></link>
        <description><?= html($site->description()) ?></description>
        <language>de-DE</language>
        <lastBuildDate><?= date('r') ?></lastBuildDate>

        <?php foreach ($articles as $article): ?>
            <item>
                <title><?= html($article->title()) ?></title>
                <link><?= html($article->url()) ?></link>
                <guid><?= html($article->url()) ?></guid>
                <pubDate><?= date('r', $article->date()->toTimestamp()) ?></pubDate>
                <description><?= html($article->description()->or($site->description())) ?></description>
            </item>
        <?php endforeach ?>
    </channel>
</rss>
