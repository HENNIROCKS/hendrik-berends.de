<?php

return [

    // Retour writes a database row for every 404 it sees. These patterns keep
    // out two kinds of noise that flood the log without ever justifying a
    // redirect: scanners expecting WordPress under this domain, and thumbnail
    // URLs of the long-removed `illustration` section that crawlers still
    // follow.
    'ignore' => [
        'wp-admin/(:all)',
        'wp-login.php',
        'xmlrpc.php',
        'media/pages/illustration/(:all)',
    ],
];
