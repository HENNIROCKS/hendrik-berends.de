<?php

/**
 * Kirby Configuration:
 * The following default configuration settings apply to the production environment.
 * All other settings from the default configuration file apply as well.
 */

return [

    'api.basicAuth' => true,

    'auth' => [
        'debug' => false,
        'methods' => [
            'password' => ['2fa' => true]
        ]
    ],

    'debug' => false,
];
