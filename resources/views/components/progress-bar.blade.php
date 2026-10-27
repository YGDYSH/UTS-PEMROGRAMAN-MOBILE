@props([
    'value' => 0,
    'tone' => 'primary',
    'size' => 'md',
])

@php
$clamped = max(0, min(100, (int) $value));
$tones = [
    'primary' => 'bg-primary',
    'accent' => 'bg-accent',
    'danger' => 'bg-danger',
    'warning' => 'bg-warning',
    'success' => 'bg-success',
    'navy' => 'bg-navy',
];
$heights = ['sm' => 'h-1.5', 'md' => 'h-2.5', 'lg' => 'h-3.5'];
@endphp

<div role="progressbar" aria-valuenow="{{ $clamped }}" aria-valuemin="0" aria-valuemax="100"
    {{ $attributes->merge(['class' => 'w-full bg-slate-200 rounded-full overflow-hidden ' . ($heights[$size] ?? $heights['md'])]) }}>
    <div class="{{ ($tones[$tone] ?? $tones['primary']) . ' ' . $heights[$size] }} rounded-full transition-all duration-500"
        style="width: {{ $clamped }}%"></div>
</div>
