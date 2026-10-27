<aside {{ $attributes->merge(['class' => 'rounded-xl bg-amber-50 border border-amber-200 p-4']) }}
    role="note" aria-label="Catatan penting tentang BMI">
    <div class="flex items-center gap-1.5 text-xs font-bold text-amber-800">
        <x-icon name="info" class="w-4 h-4" />
        Catatan Penting
    </div>
    <p class="mt-1 text-xs sm:text-sm leading-relaxed text-amber-800/90">
        BMI tidak membedakan otot dan lemak. Ini hanya perkiraan awal dan bukan diagnosis.
    </p>
</aside>
