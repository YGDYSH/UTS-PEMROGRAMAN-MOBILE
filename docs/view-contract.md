# Kontrak View BugarKu (Frontend → Backend)

Backend membaca file ini untuk menghubungkan controller ke view.
Aturan: jika nama variabel dari controller berbeda dengan daftar di bawah,
**view yang menyesuaikan** dengan kontrak ini (dan file ini diperbarui).

---

## Fase 1 — Design system, layout, komponen

### Route preview (hanya `APP_ENV=local`)

| URL | View | Variabel | Catatan |
|---|---|---|---|
| `/preview/ui` — sebenarnya `/_preview/ui` (lihat `routes/preview.php`) | `ui-preview` | tidak ada | Halaman papan tinjau semua komponen. Boleh aman dihapus di produksi. |

### Layout (anonymous blade components, dipakai via tag `x-`)

| Komponen | Penggunaan | Prop utama | Slot |
|---|---|---|---|
| `<x-guest-public-layout>` | Landing, Kalkulator BMI | `title`, `:transparent="true"` (overlay di atas hero) | default; `x-slot:textTitle` tidak ada — hanya default slot |
| `<x-auth-layout>` | Login, Register (split screen) | `title` | default (form) |
| `<x-app-layout>` | Area user | `title`, `mode="user"` (default) | default |
| `<x-admin-layout>` | Area admin (pembungkus `x-app-layout` mode admin) | `title` | default |

Catatan menu navigasi: nama asli route backend belum ada, jadi semua menu
memakai `url('/path')` sesuai tabel route di `agent.md`. Backend cukup
memastikan route dengan nama tersebut ada, frontend nanti diganti ke `route(...)`.

### Komponen UI yang tersedia (`resources/views/components/`)

- `button` — prop: `variant` (`primary|accent|outline|ghost|danger|white`), `size` (`xs|sm|md|lg`), `type`, `href`, `:loading` (spinner otomatis + disabled)
- `input` / `select` / `textarea` / `number-stepper` — prop: `name`, `label`, `hint`, `error` opsional; `number-stepper` juga `value`, `min`, `max`, `step`, `suffix`
- `chip` — prop: `name`, `value`, `type` (`checkbox`=multi / `radio`=satu), `:checked`, `tone` (`default|orange|navy`); checkbox submit sebagai `name[]`
- `card` / `stat-card` / `progress-bar` / `progress-ring` (SVG) / `badge` (`tone` warna BMI & status) / `page-header` / `empty-state` / `toast` (otomatis baca `session('success'|'error'|'status')`)
- `modal` — prop: `name`; buka dari mana saja: `$dispatch('open-modal', 'nama')`, tutup: `$dispatch('close-modal', 'nama')`; slot `trigger` opsional
- `confirm-delete` — prop: `action`, `method` (`DELETE`), `name` (nama item), slot `trigger` opsional; berisi form `@csrf` + `@method`
- `health-disclaimer` / `bmi-note` — teks wajib, dipakai di halaman BMI, onboarding, profil, nutrisi, footer
- `icon` — prop `name` (Lucide inline SVG); daftar nama dicantumkan di papan tinjau `/_preview/ui`

### Fase berikutnya

Data halaman (dashboard, program, dll.) akan didokumentasikan di file ini
setiap selesai fase.

---

## Aturan global halaman

- Semua halaman list wajib sediakan empty state.
- Semua form wajib `@csrf`, `@method` untuk non-POST, nilai `old()`, error inline,
  dan tombol submit dengan spinner saat loading.
- Semua aksi destruktif memakai `confirm-delete` (modal + form DELETE).
