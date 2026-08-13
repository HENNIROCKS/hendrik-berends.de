<?php

use Kirby\Cms\App as Kirby;

Kirby::plugin('hnnrcks/site', [
    'hooks' => [
        'kirbytext:after' => function ($text) {
            $search = [
                '<table>',
                '<thead>',
                '<th>',
                '<tbody>',
                '<tr>',
                '<td>',
            ];
            $replace = [
                '<table class="table">',
                '<thead class="table__head">',
                '<th class="table__column">',
                '<tbody class="table__body">',
                '<tr class="table__row">',
                '<td class="table__column">',
            ];
            return str_replace($search, $replace, $text);
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
