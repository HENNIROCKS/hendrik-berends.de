<?php

return [

    'pagesize' => 20,

    'thumb' => ['width' => 400, 'height' => 300, 'crop' => true],

    // MIME types accepted by the upload dialog (HTML accept attribute syntax)
    // Examples: 'image/*', 'image/*,application/pdf', '*'
    'accept' => '*',

    // Maximum upload file size in bytes (null = no limit)
    // Examples: 5 * 1024 * 1024 (5 MB), 20 * 1024 * 1024 (20 MB)
    'maxsize' => null,

];
