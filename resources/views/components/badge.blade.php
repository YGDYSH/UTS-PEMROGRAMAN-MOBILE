@props([
    'tone' => 'blue',
    'dot' => false,
])

@php
$tones = [
    'blue' => 'bg-sky-100 text-sky-800',
    'green' => 'bg-emerald-100 text-emerald-800',
    'yellow' => 'bg-amber-100 text-amber-800',
    'red' => 'bg-rose-100 text-rose-800',
    'orange' => 'bg-orange-100 text-orange-700',
    'navy' => 'bg-navy text-white',
    'gray' => 'bg-slate-100 text-slate-700',
];
$dots = [
    'blue' => 'bg-sky-500',
    'green' => 'bg-emerald-500',
    'yellow' => 'bg-amber-500',
    'red' => 'bg-rose-500',
    'orange' => 'bg-orange-500',
    'navy' => 'bg-white',
    'gray' => 'bg-slate-500',
];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold ' . ($tones[$tone] ?? $tones['gray'])]) }}>
    @if ($dot)
        <span class="w-2 h-2 rounded-full {{ $dots[$tone] ?? $dots['gray'] }}"></span>
    @endif
    {{ $slot }}
</span>
