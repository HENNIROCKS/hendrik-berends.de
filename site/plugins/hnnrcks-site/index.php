<?php

use Kirby\Cms\App as Kirby;

Kirby::plugin('hnnrcks/site', [
    'hooks' => [
        /**
         * Markdown tables get the data-table utility. Only the table itself
         * needs tagging — the utility reaches its cells by element selector,
         * so the head, body, row and cell tags no longer carry classes of
         * their own.
         */
        'kirbytext:after' => function ($text) {
            return str_replace('<table>', '<table class="data-table">', $text);
        }
    ],

    'fieldMethods' => [
        /**
         * A caption field, prepared for GLightbox's "data-description".
         *
         * GLightbox interprets a description that starts with a dot as a
         * CSS selector and would look up an element instead of showing
         * the text, so such a caption gets wrapped first. Returns null
         * for empty captions so Html::attr() drops the attribute.
         */
        'lightboxDescription' => function ($field) {
            if ($field->isEmpty()) {
                return null;
            }

            $value = trim($field->value());

            return str_starts_with($value, '.') ? '<span>' . $value . '</span>' : $value;
        }
    ],

    'tags' => [
        'heart' => [
            'html' => function ($tag) {
                return '<i class="icon icon--heart"></i>';
            }
        ]
    ],
]);
