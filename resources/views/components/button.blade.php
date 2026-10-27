@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
    'loading' => false,
])

@php
$base = 'inline-flex items-center justify-center gap-2 font-headline font-semibold rounded-button
         transition-all duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/60
         focus-visible:ring-offset-2 active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed select-none';

$variants = [
    'primary' => 'bg-primary text-white hover:bg-primary-dark shadow-sm',
    'accent' => 'bg-accent text-white hover:bg-orange-600 shadow-sm',
    'outline' => 'border border-slate-300 bg-white text-navy hover:border-primary hover:text-primary-dark',
    'ghost' => 'text-navy hover:bg-slate-100',
    'danger' => 'bg-danger text-white hover:bg-red-600 shadow-sm',
    'white' => 'bg-white text-navy hover:bg-slate-100 shadow-sm',
];

$sizes = [
    'xs' => 'min-h-9 px-3 py-1.5 text-xs',
    'sm' => 'min-h-10 px-4 py-2 text-xs sm:text-[13px]',
    'md' => 'min-h-11 px-5 py-2.5 text-sm',
    'lg' => 'min-h-12 px-7 py-3 text-base',
];

$classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}
        @if ($loading || $attributes->get('disabled'))
            aria-disabled="true"
        @endif
    >
        @if ($loading)
            <svg class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true">
                <path d="M21 12a9 9 0 1 1-9-9" />
            </svg>
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}
        @if ($loading)
            disabled
            aria-busy="true"
        @endif
    >
        @if ($loading)
            <svg class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true">
                <path d="M21 12a9 9 0 1 1-9-9" />
            </svg>
        @endif
        {{ $slot }}
    </button>
@endif
