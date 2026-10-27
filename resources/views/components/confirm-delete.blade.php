@props([
    'action',
    'method' => 'DELETE',
    'name' => null,
    'title' => 'Hapus Data Ini?',
    'text' => null,
    'confirmText' => 'Hapus',
    'cancelText' => 'Batal',
    'maxWidth' => 'max-w-sm',
])

@php
$modalName = 'confirm-delete-' . md5($action);
@endphp

<x-modal :name="$modalName" :title="$title" :max-width="$maxWidth">
    @isset($trigger)
        <x-slot name="trigger">
            {{ $trigger }}
        </x-slot>
    @endisset

    <p class="text-sm text-muted leading-relaxed">
        {{ $text ?? 'Data yang dihapus tidak bisa dikembalikan. Pastikan kamu yakin sebelum melanjutkan.' }}
        @if ($name)
            <strong class="text-navy font-semibold">&ldquo;{{ $name }}&rdquo;</strong>
        @endif
    </p>

    <div class="flex justify-end gap-2 mt-6">
        <x-button variant="ghost" size="sm" x-on:click="$dispatch('close-modal', {{ json_encode($modalName) }})">
            {{ $cancelText }}
        </x-button>
        <form action="{{ $action }}" method="POST" x-on:submit="$dispatch('close-modal', {{ json_encode($modalName) }})">
            @csrf
            @method(strtoupper($method))
            <x-button type="submit" variant="danger" size="sm">
                <x-icon name="trash" class="w-4 h-4" />
                {{ $confirmText }}
            </x-button>
        </form>
    </div>
</x-modal>