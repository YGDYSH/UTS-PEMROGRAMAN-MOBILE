@props([
    'name',
    'label' => null,
    'value' => 0,
    'min' => 0,
    'max' => 999,
    'step' => 1,
    'suffix' => '',
])

@php
$invalid = $errors->first($name);
@endphp

<div class="w-full" x-data="{
    v: {{ (int) $value }},
    min: {{ (int) $min }},
    max: {{ (int) $max }},
    step: {{ (int) $step }},
    suffix: {{ json_encode($suffix) }},
    clamp() { this.v = Math.min(this.max, Math.max(this.min, this.v)); }
}">
    @if ($label)
        <label for="{{ $id ?? $name }}" class="block mb-1.5 text-sm font-medium text-navy">
            {{ $label }}
        </label>
    @endif

    <div class="inline-flex items-stretch h-11 border rounded-button overflow-hidden
        {{ $invalid ? 'border-danger' : 'border-slate-300 focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20' }}"
        @keydown.arrow-up.prevent="clamp(); v = Math.min(max, v + step)"
        @keydown.arrow-down.prevent="clamp(); v = Math.max(min, v - step)">
        <input type="hidden" name="{{ $name }}" :value="v">
        <button type="button" @click="clamp(); v = Math.max(min, v - step)" aria-label="Kurangi nilai"
            class="w-11 flex items-center justify-center text-navy bg-white hover:bg-slate-100 active:bg-slate-200 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-primary/60">
            <span class="text-xl font-semibold leading-none pb-0.5">&minus;</span>
        </button>
        <div class="min-w-16 px-3 flex items-center justify-center border-x border-slate-300 bg-white"
            x-text="v + (suffix ? ' ' + suffix : '')" :aria-label="{{ json_encode($label ?? 'Nilai') }}"></div>
        <button type="button" @click="clamp(); v = Math.min(max, v + step)" aria-label="Tambah nilai"
            class="w-11 flex items-center justify-center text-navy bg-white hover:bg-slate-100 active:bg-slate-200 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-primary/60">
            <span class="text-xl font-semibold leading-none pb-0.5">+</span>
        </button>
    </div>

    @if ($invalid)
        <p id="{{ $name }}-error" class="mt-1.5 flex items-center gap-1 text-xs text-danger">
            <x-icon name="info" class="w-3.5 h-3.5 shrink-0" />
            {{ $invalid }}
        </p>
    @endif
</div>
