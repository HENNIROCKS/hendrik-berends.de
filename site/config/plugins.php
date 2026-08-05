<?php

$options = [];

foreach (glob(__DIR__ . '/plugins/*.php') as $file) {
    $prefix = basename($file, '.php');

    foreach (require $file as $key => $value) {
        $options[$prefix . '.' . $key] = $value;
    }
}

return $options;
