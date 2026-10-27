# Permintaan Frontend ke Backend

Daftar kebutuhan frontend yang BELUM ada di sisi backend. Jangan dijawab di
repo frontend; backend membangunnya di scope backend.

## Dari Phase 1

1. **Laravel Breeze (Blade stack) belum terpasang** — prasyarat Phase 0 backend.
   Dibutuhkan untuk: view auth bawaan (`/login`, `/register`, `/logout`),
   redirect-middleware, dan route profil ringan. Frontend sudah membuat
   `layouts/auth` split-screen yang akan dipakai untuk restyle view Breeze di
   Phase 3.
2. **Route auth**: `/register`, `/login`, `/logout` (POST) belum ada; semua
   tombol login/daftar/keluar di layout memakai `url('/login')`,
   `url('/register')`, dan POST `url('/logout')` dengan `@csrf`.
3. **`auth()->user()->name` / `->email`** dipakai di topbar area user/admin —
   sempat dipanggil saat belum login pun aman (null-safe via `??`), tapi layout
   nanti perlu user context dari middleware Breeze.
4. Halaman error kustom (403/404/419/500) baru dibuat di Phase 3; sementara
   fitur error default Laravel berlaku.
