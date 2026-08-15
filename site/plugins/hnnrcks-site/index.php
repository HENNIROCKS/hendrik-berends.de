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
        /**
         * The heart is the one icon that carries a colour of its own, in both
         * modes alike — every other icon inherits it from the surrounding
         * text. src/css/styles.css lists this file as a Tailwind source, so
         * the class below is actually emitted.
         */
        'heart' => [
            'html' => function ($tag) {
                $icon = snippet('icon', [
                    'name' => 'heart',
                    'class' => 'text-salmon-500',
                ], true);

                // Markdown runs after the tag and treats a line break inside
                // the SVG as a paragraph boundary, which tears the <use> out
                // of its <svg>. Collapsing to one line keeps it inline.
                return preg_replace('/\s*\R\s*/', '', trim($icon));
            }
        ]
    ],
]);
