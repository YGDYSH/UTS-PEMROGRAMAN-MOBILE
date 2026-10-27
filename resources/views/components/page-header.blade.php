@props([
    'title' => null,
    'subtitle' => null,
])

@if ($title)
    <div class="flex flex-wrap items-end justify-between gap-3 mb-5 sm:mb-6">
        <div>
            <h1 class="font-headline text-xl sm:text-2xl font-bold text-navy tracking-tight">{{ $title }}</h1>
            @if ($subtitle)
                <p class="mt-1 text-sm text-muted">{{ $subtitle }}</p>
            @endif
        </div>
        @isset($actions)
            <div class="flex flex-wrap items-center gap-2">{{ $actions }}</div>
        @endisset
    </div>
@else
    <div class="flex flex-wrap items-end justify-between gap-3 mb-5 sm:mb-6">
        <div class="min-w-0">{{ $slot }}</div>
        @isset($actions)
            <div class="flex flex-wrap items-center gap-2">{{ $actions }}</div>
        @endisset
    </div>
@endif
