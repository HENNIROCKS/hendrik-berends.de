<?php

return [

    // Retour legt für jeden 404 eine Zeile in seiner SQLite-Datenbank an. Die
    // Muster hier halten zwei Sorten Rauschen heraus, die den Log fluten, ohne
    // je eine Weiterleitung zu rechtfertigen: Scanner, die WordPress unter
    // dieser Domain vermuten, und Thumbnail-URLs des längst entfernten
    // `illustration`-Bereichs, die Crawler weiterhin abrufen.
    'ignore' => [
        'wp-admin/(:all)',
        'wp-login.php',
        'xmlrpc.php',
        'media/pages/illustration/(:all)',
    ],
];
