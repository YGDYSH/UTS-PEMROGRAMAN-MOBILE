@props([
    'title' => null,
    'subtitle' => null,
    'padding' => 'p-5 sm:p-6',
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-card shadow-card border border-slate-100']) }}>
    @if ($title)
        <div class="flex items-start justify-between gap-3 @if ($padding !== 'p-0') {{ 'p-5 sm:p-6 pb-0' }} @endif">
            <div>
                <h2 class="font-headline text-base sm:text-lg font-bold text-navy">{{ $title }}</h2>
                @if ($subtitle)
                    <p class="mt-0.5 text-xs sm:text-sm text-muted">{{ $subtitle }}</p>
                @endif
            </div>
            @isset($actions)
                <div class="flex shrink-0 items-center gap-2">{{ $actions }}</div>
            @endisset
        </div>
        <div class="{{ $padding }}">{{ $slot }}</div>
    @else
        <div class="{{ $padding === '' ? '' : $padding }}">{{ $slot }}</div>
    @endif
</div>
