<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

// buat request
$request = Request::capture();

// ambil kernel
$kernel = $app->make(Kernel::class);

// handle request
$response = $kernel->handle($request);

// kirim response ke browser
$response->send();

// terminate
$kernel->terminate($request, $response);