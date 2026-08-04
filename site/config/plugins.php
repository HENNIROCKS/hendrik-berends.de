<?php

$plugins = [];

foreach (glob(__DIR__ . '/plugins/*.php') as $file) {
    $plugins[basename($file, '.php')] = require $file;
}

return $plugins;
