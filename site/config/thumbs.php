<?php

return [

    'driver' => 'imagick',

    'srcsets' => [
        'preview' => [
            '640w'  => ['width' => 640,  'crop' => true, 'quality' => 80],
            '1280w' => ['width' => 1280, 'crop' => true, 'quality' => 80],
        ],
        'preview-avif' => [
            '640w'  => ['width' => 640,  'crop' => true, 'quality' => 65, 'format' => 'avif'],
            '1280w' => ['width' => 1280, 'crop' => true, 'quality' => 65, 'format' => 'avif'],
        ],
        'preview-webp' => [
            '640w'  => ['width' => 640,  'crop' => true, 'quality' => 75, 'format' => 'webp'],
            '1280w' => ['width' => 1280, 'crop' => true, 'quality' => 75, 'format' => 'webp'],
        ],
        'content' => [
            '640w'  => ['width' => 640,  'quality' => 80],
            '768w'  => ['width' => 768,  'quality' => 80],
            '1024w' => ['width' => 1024, 'quality' => 80],
            '1280w' => ['width' => 1280, 'quality' => 80],
            '1536w' => ['width' => 1536, 'quality' => 80],
        ],
        'content-avif' => [
            '640w'  => ['width' => 640,  'quality' => 65, 'format' => 'avif'],
            '768w'  => ['width' => 768,  'quality' => 65, 'format' => 'avif'],
            '1024w' => ['width' => 1024, 'quality' => 65, 'format' => 'avif'],
            '1280w' => ['width' => 1280, 'quality' => 65, 'format' => 'avif'],
            '1536w' => ['width' => 1536, 'quality' => 65, 'format' => 'avif'],
        ],
        'content-webp' => [
            '640w'  => ['width' => 640,  'quality' => 75, 'format' => 'webp'],
            '768w'  => ['width' => 768,  'quality' => 75, 'format' => 'webp'],
            '1024w' => ['width' => 1024, 'quality' => 75, 'format' => 'webp'],
            '1280w' => ['width' => 1280, 'quality' => 75, 'format' => 'webp'],
            '1536w' => ['width' => 1536, 'quality' => 75, 'format' => 'webp'],
        ],
    ],
];
