@props([
    'name',
    'value',
    'type' => 'checkbox',
    'checked' => false,
    'tone' => 'default',
])

@php
// Chip bisa dipilih (checkbox = multi select, radio = pilih satu).
$tones = [
    'default' => 'peer-checked:bg-primary/10 peer-checked:border-primary peer-checked:text-primary-dark',
    'orange' => 'peer-checked:bg-accent/10 peer-checked:border-accent peer-checked:text-orange-600',
    'navy' => 'peer-checked:bg-navy peer-checked:border-navy peer-checked:text-white',
];
$toneClass = $tones[$tone] ?? $tones['default'];
@endphp

<label {{ $attributes->merge(['class' => 'group cursor-pointer']) }}>
    <input type="{{ $type }}"
        name="{{ $type === 'checkbox' ? $name . '[]' : $name }}"
        value="{{ $value }}" @checked((bool) $checked)
        class="peer sr-only">

    <span class="inline-flex items-center justify-center gap-1.5 min-h-10 px-4 py-2 rounded-full border text-xs sm:text-sm
        bg-white text-navy border-slate-300 hover:border-primary/60 transition-colors duration-150
        focus-within:ring-2 focus-within:ring-primary/40 focus-within:ring-offset-1
        {{ $toneClass }}">
        {{ $slot }}
    </span>
</label>
