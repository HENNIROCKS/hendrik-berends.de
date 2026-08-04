<?php

return [

    'instance' => env('MASTODON_INSTANCE'),
    'token'    => env('MASTODON_TOKEN'),

    'post.default' => function ($page) {
        $text = $page->title();

        $hashtags = array_slice($page->keywords()->split(','), 0, 5);
        if (!empty($hashtags)) {
            $hashtags = array_map(
                fn($tag) => '#' . preg_replace('/[^\p{L}\p{N}]/u', '', $tag),
                $hashtags
            );
            $text .= "\n\n" . implode(' ', $hashtags);
        }

        $text .= "\n\n" . $page->url();

        return $text;
    },
];
