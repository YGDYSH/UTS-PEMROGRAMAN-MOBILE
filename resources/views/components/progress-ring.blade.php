@props([
    'value' => 0,
    'label' => null,
    'sublabel' => null,
    'size' => 112,
    'stroke' => 10,
    'tone' => 'primary',
])

@php
$clamped = max(0, min(100, (int) $value));
$radius = (max(40, (int) $size) / 2) - $stroke;
$circumference = 2 * M_PI * $radius;
$offset = $circumference * (1 - $clamped / 100);
$colors = [
    'primary' => '#10B981',
    'primary-dark' => '#047857',
    'accent' => '#F97316',
    'warning' => '#F59E0B',
    'danger' => '#EF4444',
    'success' => '#22C55E',
    'navy' => '#0F172A',
];
$strokeColor = $colors[$tone] ?? $colors['primary'];
@endphp

<div class="relative inline-flex items-center justify-center shrink-0" style="width: {{ $size }}px; height: {{ $size }}px"
    role="img" aria-label="{{ $sublabel ?? $label ?? 'Progres ' . $clamped . ' persen' }}">
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 {{ $size + 8 + $stroke * 2 }} {{ $size + 8 + $stroke * 2 }}" class="absolute inset-0 translate-x-[-4px] translate-y-[-4px]">
        <circle cx="{{ ($size + 8) / 2 + $stroke }}" cy="{{ ($size + 8) / 2 + $stroke }}" r="{{ $radius }}"
            fill="none" stroke="#E2E8F0" stroke-width="{{ $stroke }}" />
        <circle cx="{{ ($size + 8) / 2 + $stroke }}" cy="{{ ($size + 8) / 2 + $stroke }}" r="{{ $radius }}"
            fill="none" stroke="{{ $strokeColor }}" stroke-width="{{ $stroke }}" stroke-linecap="round"
            stroke-dasharray="{{ $circumference }}" stroke-dashoffset="{{ $offset }}"
            transform="rotate(-90 {{ ($size + 8) / 2 + $stroke }} {{ ($size + 8) / 2 + $stroke }})" />
    </svg>
    <div class="text-center leading-tight">
        @isset($slot)
            {{ $slot }}
        @else
            <span class="block font-headline font-extrabold text-navy" style="font-size: {{ max(16, $size * 0.22) }}px">{{ $clamped }}%</span>
            @if ($label)
                <span class="block text-[10px] sm:text-xs text-muted mt-0.5 max-w-[90px] mx-auto">{{ $label }}</span>
            @endif
        @endif
    </div>
</div>
