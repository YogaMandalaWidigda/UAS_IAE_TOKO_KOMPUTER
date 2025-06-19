<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Ini adalah file routing untuk web (GET).
| Di sini kita akan menambahkan route ke halaman GraphQL Playground.
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/playground', function () {
    return response()->view('playground')
        ->header('Content-Security-Policy', "default-src * 'unsafe-inline' 'unsafe-eval' data: blob:;");
});

