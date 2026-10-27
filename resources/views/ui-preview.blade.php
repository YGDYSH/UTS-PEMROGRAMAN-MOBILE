<x-guest-public-layout title="UI Preview" :transparent="false">

    {{-- ===================== TOKEN ===================== --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 space-y-8">
        <x-page-header title="UI Preview — Design System" subtitle="Pratinjau fase 1: semua komponen beserta suasana warna untuk review visual.">
            <x-slot:actions>
                <x-badge tone="green" dot>Tailwind v4 + Alpine</x-badge>
            </x-slot:actions>
        </x-page-header>

        <x-card title="Warna Utama & Status" subtitle="Palet design token BugarKu">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                <div><div class="h-10 rounded-xl bg-primary"></div>primary #10B981</div>
                <div><div class="h-10 rounded-xl bg-primary-dark"></div>primary-dark #047857</div>
                <div><div class="h-10 rounded-xl bg-accent"></div>accent #F97316</div>
                <div><div class="h-10 rounded-xl bg-navy"></div>navy #0F172A</div>
                <div><div class="h-10 rounded-xl bg-surface border border-slate-200"></div>surface #F8FAFC</div>
                <div><div class="h-10 rounded-xl bg-muted"></div>muted #64748B</div>
                <div><div class="h-10 rounded-xl bg-success"></div>success #22C55E</div>
                <div><div class="h-10 rounded-xl bg-warning"></div>warning #F59E0B</div>
                <div><div class="h-10 rounded-xl bg-danger"></div>danger #EF4444</div>
                <div><div class="h-10 rounded-xl bg-bmi-kurus"></div>BMI Kurus (biru)</div>
                <div><div class="h-10 rounded-xl bg-bmi-normal"></div>BMI Normal (hijau)</div>
                <div><div class="h-10 rounded-xl bg-bmi-gemuk"></div>BMI Gemuk (kuning)</div>
            </div>
        </x-card>

        <x-card title="Tipografi" subtitle="Poppins untuk heading, Inter untuk body">
            <div class="space-y-2">
                <p class="font-headline text-2xl sm:text-3xl font-black text-navy tracking-tight">Heading Poppins Bold — BugarKu</p>
                <p class="font-sans text-sm sm:text-base text-muted">Body Inter regular — Kalori harianmu: 1.980 kkal. Target latihan 4 hari per minggu.</p>
            </div>
        </x-card>
    </section>

    {{-- ===================== BUTTON ===================== --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 space-y-4">
        <h2 class="font-headline font-bold text-navy text-lg">Button</h2>
        <x-card>
            <div class="flex flex-wrap items-center gap-3">
                <x-button variant="primary">Primary</x-button>
                <x-button variant="accent"><x-icon name="play" class="w-4 h-4" /> Accent</x-button>
                <x-button variant="outline">Outline</x-button>
                <x-button variant="ghost">Ghost</x-button>
                <x-button variant="danger"><x-icon name="trash" class="w-4 h-4" /> Danger</x-button>
                <x-button variant="white" href="#">White href</x-button>
                <x-button variant="primary" :loading="true">Loading</x-button>
                <x-button variant="primary" size="sm">Small</x-button>
                <x-button variant="primary" size="lg">Large</x-button>
            </div>
        </x-card>
    </section>

    {{-- ===================== FORM ===================== --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 space-y-4">
        <h2 class="font-headline font-bold text-navy text-lg">Input, Select, Textarea, Stepper, Chip</h2>
        <x-card>
            <form class="grid sm:grid-cols-2 gap-5" onsubmit="return false;">
                <x-input name="ui_nama" label="Nama Lengkap" placeholder="contoh: Rian Pratama" hint="Nama dipakai di sapaan dashboard." />
                <x-input name="ui_email" label="Email" type="email" placeholder="nama@email.com" />
                <x-input name="ui_tinggi" label="Tinggi (ada error)" type="number" :value="999" :error="'Tinggi harus antara 100 dan 250 cm'" />
                <x-select name="ui_level" label="Level Latihan" placeholder="Pilih level..." :options="['beginner' => 'Pemula', 'intermediate' => 'Menengah', 'advanced' => 'Lanjutan']" />
                <div class="sm:col-span-2">
                    <x-textarea name="ui_catatan" label="Catatan Program" placeholder="Tulis catatan latihanmu..." rows="3" />
                </div>
                <div><x-number-stepper name="ui_set" label="Jumlah Set" :value="3" :min="1" :max="10" suffix="set" /></div>
                <div><x-number-stepper name="ui_reps" label="Repetisi" :value="12" :min="1" :max="50" suffix="rep" /></div>
            </form>

            <div class="mt-6 space-y-4">
                <div>
                    <p class="text-sm font-medium text-navy mb-2">Chip — pilih banyak (checkbox):</p>
                    <div class="flex flex-wrap gap-2">
                        <x-chip name="ui_alat" value="tanpa-alat" :checked="true">Tanpa Alat</x-chip>
                        <x-chip name="ui_alat" value="dumbbell">Dumbbell</x-chip>
                        <x-chip name="ui_alat" value="gym" tone="orange">Gym Lengkap</x-chip>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-navy mb-2">Chip — pilih satu (radio):</p>
                    <div class="flex flex-wrap gap-2">
                        <x-chip name="ui_tujuan" value="lose_weight" type="radio" :checked="true">Turun Berat Badan</x-chip>
                        <x-chip name="ui_tujuan" value="build_muscle" type="radio">Bentuk Otot</x-chip>
                        <x-chip name="ui_tujuan" value="stamina" type="radio" tone="navy">Stamina</x-chip>
                    </div>
                </div>
            </div>
        </x-card>
    </section>

    {{-- ===================== CARD & STAT ===================== --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 space-y-4">
        <h2 class="font-headline font-bold text-navy text-lg">Card, Stat Card, Badge</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <x-stat-card label="BMI Saat Ini" value="22,4" tone="primary" :trend="'Turun 0,3 dari kemarin'">
                <x-icon slot="icon" name="scale" class="w-5 h-5" />
            </x-stat-card>
            <x-stat-card label="Berat Badan" value="63,5 kg" tone="accent" :trend="'-1,2 kg / bulan'">
                <x-icon slot="icon" name="scale" class="w-5 h-5" />
            </x-stat-card>
            <x-stat-card label="Streak Latihan" value="12 hari" tone="warning">
                <x-icon slot="icon" name="flame" class="w-5 h-5" />
            </x-stat-card>
            <x-stat-card label="Latihan Minggu Ini" value="3 / 4 hari" tone="navy">
                <x-icon slot="icon" name="dumbbell" class="w-5 h-5" />
            </x-stat-card>
        </div>
        <div class="grid sm:grid-cols-3 gap-4">
            <x-badge tone="green" dot>Normal</x-badge>
            <x-badge tone="blue" dot>Kurus</x-badge>
            <x-badge tone="yellow" dot>Gemuk</x-badge>
            <x-badge tone="red" dot>Obesitas</x-badge>
            <x-badge tone="orange">Perlu Penyesuaian</x-badge>
            <x-badge tone="navy">Sesuai Target</x-badge>
        </div>
    </section>

    {{-- ===================== PROGRESS ===================== --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 space-y-4">
        <h2 class="font-headline font-bold text-navy text-lg">Progress Bar &amp; Progress Ring</h2>
        <x-card>
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-muted mb-1.5">Progres mingguan 64%</p>
                    <x-progress-bar :value="64" tone="primary" />
                </div>
                <div>
                    <p class="text-sm text-muted mb-1.5">Progres target berat 40% (accent)</p>
                    <x-progress-bar :value="40" tone="accent" />
                </div>
                <div class="flex flex-wrap items-center gap-6">
                    <x-progress-ring :value="72" sublabel="Target tercapai" />
                    <x-progress-ring :value="35" tone="accent" sublabel="Berat capaian" />
                    <x-progress-ring :value="90" tone="success" sublabel="Konsistensi" />
                </div>
            </div>
        </x-card>
    </section>

    {{-- ===================== MODAL & DELETE ===================== --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 space-y-4">
        <h2 class="font-headline font-bold text-navy text-lg">Modal &amp; Konfirmasi Hapus</h2>
        <x-card>
            <div class="flex flex-wrap items-center gap-3">
                <div>
                    <x-modal name="ui-modal" title="Modal Demo" max-width="max-w-md">
                        <x-slot:trigger>
                            <x-button variant="primary">Buka Modal</x-button>
                        </x-slot:trigger>
                        <p class="text-sm text-muted">Isi modal demo untuk review fase 1. Tombol Tutup di kanan atas dan tombol Batal bekerja sama.</p>
                        <div class="mt-4 grid grid-cols-2 gap-2">
                            <x-input name="ui_modal_isi" label="Nama Kegiatan" placeholder="Push-up" />
                            <div><x-number-stepper name="ui_modal_jumlah" label="Jumlah" :value="3" :min="1" :max="20" /></div>
                        </div>
                    </x-modal>
                </div>

                {{-- Trigger hapus langsung --}}
                <x-confirm-delete action="#" :name="'Program Full Body Pemula'">
                    <x-slot:trigger>
                        <x-button variant="danger" size="sm">
                            <x-icon name="trash" class="w-4 h-4" /> Hapus Program
                        </x-button>
                    </x-slot:trigger>
                </x-confirm-delete>
            </div>
        </x-card>
    </section>

    {{-- ===================== EMPTY & HEADER ===================== --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 space-y-4">
        <h2 class="font-headline font-bold text-navy text-lg">Empty State &amp; Health Disclaimer</h2>
        <div class="grid sm:grid-cols-2 gap-4">
            <x-empty-state icon="dumbbell" title="Belum ada program latihan" text="Buat program pertamamu supaya timer latihan langsung terbuka.">
                <x-slot:actions>
                    <x-button variant="primary" size="sm"><x-icon name="plus" class="w-4 h-4" /> Buat Program</x-button>
                </x-slot:actions>
            </x-empty-state>
            <div class="space-y-4">
                <x-health-disclaimer />
                <x-bmi-note />
            </div>
        </div>
    </section>

    {{-- ===================== ICONS ===================== --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 space-y-6 pb-14">
        <h2 class="font-headline font-bold text-navy text-lg">Ikon (Lucide inline SVG)</h2>
        <x-card>
            <div class="grid grid-cols-4 sm:grid-cols-8 lg:grid-cols-10 gap-4 text-center text-[10px] text-muted">
                @foreach (['home','dumbbell','activity','user','flame','utensils','target','bar-chart','settings','log-out','plus','pencil','trash','check','x','menu','chevron-right','chevron-left','chevron-down','chevron-up','arrow-up-right','arrow-left','heart','scale','calendar','play','timer','search','eye','eye-off','info','zap','mail','bell','lock','stethoscope','list'] as $uiIcon)
                    <div class="flex flex-col items-center gap-1.5 p-2 rounded-xl hover:bg-slate-50 transition">
                        <x-icon name="{{ $uiIcon }}" class="w-6 h-6 text-navy" />
                        <span class="truncate w-full">{{ $uiIcon }}</span>
                    </div>
                @endforeach
            </div>
        </x-card>
    </section>
</x-guest-public-layout>
