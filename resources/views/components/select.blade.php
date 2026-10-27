@props([
    'name',
    'label' => null,
    'options' => [],
    'placeholder' => null,
    'hint' => null,
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
        <select id="{{ $id ?? $name }}" name="{{ $name }}"
            @if ($invalid) aria-invalid="true" aria-describedby="{{ $name }}-error" @endif
            {{ $attributes->merge(['class' => 'w-full h-11 px-4 pr-10 text-sm text-navy bg-white border rounded-button appearance-none cursor-pointer transition-colors duration-150
                ' . ($invalid ? 'border-danger focus:border-danger focus:ring-2 focus:ring-danger/20' : 'border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20')
                . ' focus:outline-none']) }}>
            @if ($placeholder !== null)
                <option value="" @selected(! old($name, $value ?? null))>{{ $placeholder }}</option>
            @endif
            @foreach ($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @selected((string) old($name, $value ?? '') === (string) $optionValue)>{{ $optionLabel }}</option>
            @endforeach
        </select>
        <x-icon name="chevron-down" class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-muted pointer-events-none" />
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
