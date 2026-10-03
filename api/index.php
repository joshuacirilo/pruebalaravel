<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

// Vercel only permits runtime writes in its temporary directory.
$storage = sys_get_temp_dir().'/laravel-storage';

foreach (['framework/views', 'framework/sessions', 'framework/cache/data', 'logs'] as $directory) {
    $path = $storage.'/'.$directory;

    if (! is_dir($path) && ! mkdir($path, 0755, true) && ! is_dir($path)) {
        throw new RuntimeException('Unable to create temporary storage.');
    }
}

$app = require __DIR__.'/../bootstrap/app.php';
$app->useStoragePath($storage);

$app->handleRequest(Request::capture());
