@props([
    'title' => 'Belum ada data',
    'text' => null,
    'icon' => 'bar-chart',
    'tone' => 'primary',
])

@php
$iconBg = [
    'primary' => 'bg-primary/10 text-primary',
    'accent' => 'bg-accent/10 text-accent',
    'navy' => 'bg-navy/10 text-navy',
];
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-card border border-dashed border-slate-300 p-8 sm:p-12 text-center']) }}>
    <div class="w-14 h-14 mx-auto rounded-2xl flex items-center justify-center {{ $iconBg[$tone] ?? $iconBg['primary'] }}">
        <x-icon :name="$icon" class="w-7 h-7" />
    </div>
    <h3 class="font-headline font-bold text-navy mt-4">{{ $title }}</h3>
    <p class="text-sm text-muted mt-1 max-w-sm mx-auto">{{ $text ?? 'Belum ada data yang bisa ditampilkan. Mulai dengan menambahkan data baru.' }}</p>
    @isset($actions)
        <div class="mt-5 flex justify-center gap-2">{{ $actions }}</div>
    @endisset
</div>
