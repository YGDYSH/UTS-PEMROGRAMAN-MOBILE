<?php

// FRONTEND-PREVIEW — Hanya berjalan saat APP_ENV=local (lihat routes/web.php).
// Route di sini memakai prefix /_preview jadi tidak akan pernah bentrok dengan
// route asli dari backend. Data dummy diisi langsung di file view masing-masing.

use Illuminate\Support\Facades\Route;

Route::prefix('_preview')->group(function () {
    // Papan tinjau: semua komponen & varian design system Phase 1.
    Route::view('/ui', 'ui-preview')->name('preview.ui');
});
