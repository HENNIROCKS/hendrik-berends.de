<?php

use Kirby\Cms\App as Kirby;

Kirby::plugin('hnnrcks/site', [
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
