<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// FRONTEND-PREVIEW: hanya aktif di lingkungan local; tidak boleh jalan di produksi.
if (app()->environment('local')) {
    require __DIR__ . '/preview.php';
}
