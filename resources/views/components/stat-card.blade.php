@props([
    'label',
    'value',
    'trend' => null,
    'tone' => 'primary',
])

@php
$tones = [
    'primary' => 'text-primary',
    'accent' => 'text-accent',
    'navy' => 'text-navy',
    'warning' => 'text-warning',
    'danger' => 'text-danger',
    'success' => 'text-success',
];
$iconBg = [
    'primary' => 'bg-primary/10 text-primary',
    'accent' => 'bg-accent/10 text-accent',
    'navy' => 'bg-navy/10 text-navy',
    'warning' => 'bg-warning/10 text-warning',
    'danger' => 'bg-danger/10 text-danger',
    'success' => 'bg-success/10 text-success',
];
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-card shadow-card border border-slate-100 p-4 sm:p-5 flex items-start justify-between gap-3']) }}>
    <div class="min-w-0">
        <p class="text-xs font-medium text-muted truncate">{{ $label }}</p>
        <p class="font-headline text-xl sm:text-2xl font-extrabold text-navy mt-1 tracking-tight">{{ $value }}</p>
        @if ($trend)
            <p class="mt-1 text-xs {{ ($tone === 'success' || $tone === 'primary') ? 'text-success' : ($tone === 'danger' ? 'text-danger' : 'text-muted') }}">{{ $trend }}</p>
        @endif
        @isset($slot)
            <div class="mt-2">{{ $slot }}</div>
        @endisset
    </div>
    @isset($icon)
        <div class="shrink-0 w-10 h-10 rounded-xl flex items-center justify-center {{ ($iconBg[$tone] ?? $iconBg['primary']) }}">
            {{ $icon }}
        </div>
    @endisset
</div>
