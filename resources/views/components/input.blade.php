@props([
    'name',
    'label' => null,
    'type' => 'text',
    'hint' => null,
    'help' => null,
    'error' => $errors->first($name),
])

@php
$invalid = $error !== null;
@endphp

<div class="w-full">
    @if ($label)
        <label for="{{ $id ?? $name }}" class="block mb-1.5 text-sm font-medium text-navy">
            {{ $label }}
            @if ($attributes->get('required'))
                <span class="text-danger" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <input id="{{ $id ?? $name }}" name="{{ $name }}" type="{{ $type }}"
            @if ($type !== 'checkbox' && $type !== 'radio') value="{{ old($name, $value ?? '') }}" @endif
            @if ($invalid) aria-invalid="true" aria-describedby="{{ $name }}-error" @endif
            {{ $attributes->merge(['class' => 'w-full h-11 px-4 text-sm text-navy rounded-button bg-white border transition-colors duration-150
                ' . ($invalid ? 'border-danger focus:border-danger focus:ring-2 focus:ring-danger/20' : 'border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20')
                . ' placeholder:text-muted/70 focus:outline-none']) }}>
    </div>

    @if ($invalid)
        <p id="{{ $name }}-error" class="mt-1.5 flex items-center gap-1 text-xs text-danger">
            <x-icon name="info" class="w-3.5 h-3.5 shrink-0" />
            {{ $error }}
        </p>
    @elseif ($hint)
        <p class="mt-1.5 text-xs text-muted">{{ $hint }}</p>
    @endif
</div>
