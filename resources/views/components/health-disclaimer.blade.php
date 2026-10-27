<aside {{ $attributes->merge(['class' => 'rounded-xl border border-warning/30 bg-amber-50 p-4 flex items-start gap-3']) }}
    role="note" aria-label="Catatan kesehatan">
    <span class="w-8 h-8 rounded-lg bg-warning/15 text-warning flex items-center justify-center shrink-0">
        <x-icon name="stethoscope" class="w-4.5 h-4.5" />
    </span>
    <div>
        <p class="font-headline text-xs sm:text-sm font-bold text-amber-800">Disclaimer Medis &amp; Kesehatan</p>
        <p class="mt-1 text-xs sm:text-sm leading-relaxed text-amber-900/90">
            Informasi di BugarKu hanya untuk edukasi kebugaran umum dan skrining awal mandiri — bukan pengganti
            diagnosis, terapi, atau saran medis dari dokter, perawat, atau ahli gizi. Jika kamu hamil, lansia,
            atlet, atau punya riwayat gangguan metabolik, konsultasikan dulu ke tenaga medis profesional.
        </p>
    </div>
</aside>
