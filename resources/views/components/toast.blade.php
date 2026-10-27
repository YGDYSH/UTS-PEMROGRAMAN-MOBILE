@props([
    'tone' => null,
    'text' => null,
    'autoClose' => true,
    'wrapperClass' => 'rounded-xl border shadow-soft flex items-start gap-3 px-4 py-3',
])

@php
// Sumber pesan: text/slot (paksa) atau flash session.
$message = $text = ($text ?? null);
if ($message === null && $slot->isNotEmpty()) {
    $message = trim((string) $slot);
}
if ($message === null) {
    if (session('success')) {
        $message = session('success');
        $tone = $tone ?? 'success';
    } elseif (session('error')) {
        $message = session('error');
        $tone = $tone ?? 'error';
    } elseif (session('status')) {
        $message = session('status');
        $tone = $tone ?? 'info';
    }
}
$tone = $tone ?? 'info';

$styles = [
    'success' => 'bg-white text-success border-slate-100',
    'error' => 'bg-white text-danger border-slate-100',
    'info' => 'bg-white text-navy border-slate-100',
];
$icons = [
    'success' => 'check-circle',
    'error' => 'x',
    'info' => 'info',
];
$iconTones = [
    'success' => 'text-success bg-success/10',
    'error' => 'text-danger bg-danger/10',
    'info' => 'text-primary bg-primary/10',
];
@endphp

@if ($message)
    <div x-data="{ show: true }"
        @if ($autoClose)
            x-init="setTimeout(() => show = false, 4000)"
        @endif
        x-cloak x-show="show" x-transition.duration.300ms
        role="status" aria-live="polite"
        {{ $attributes->merge(['class' => $wrapperClass . ' ' . ($styles[$tone] ?? $styles['info'])]) }}>
        <span class="w-7 h-7 rounded-full flex items-center justify-center shrink-0 {{ $iconTones[$tone] ?? $iconTones['info'] }}">
            <x-icon :name="$icons[$tone] ?? $icons['info']" class="w-4 h-4" />
        </span>
        <p class="text-sm leading-relaxed flex-1 {{ $tone === 'info' ? 'text-navy' : '' }}">
            {{ $message }}
        </p>
        <button type="button" x-on:click="show = false" aria-label="Tutup notifikasi"
            class="shrink-0 w-7 h-7 rounded-lg flex items-center justify-center text-muted hover:text-navy hover:bg-slate-100 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/60">
            <x-icon name="x" class="w-4 h-4" />
        </button>
    </div>
@endif
