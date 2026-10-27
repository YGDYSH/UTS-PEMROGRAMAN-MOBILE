@props([
    'name' => 'modal',
    'title' => null,
    'maxWidth' => 'max-w-md',
])

<div x-data="{ open: false }"
    x-on:open-modal.window="if ($event.detail === {{ json_encode($name) }}) open = true"
    x-on:close-modal.window="if ($event.detail === {{ json_encode($name) }}) open = false"
    @keydown.escape.window="open = false"
    {{ $attributes }}>

    @isset($trigger)
        <div x-on:click="$dispatch('open-modal', {{ json_encode($name) }})">
            {{ $trigger }}
        </div>
    @endisset

    {{-- Overlay & dialog --}}
    <div x-cloak x-show="open" class="contents">
        <div x-show="open" x-transition.opacity.duration.200ms class="fixed inset-0 bg-navy/60 backdrop-blur-sm"
            x-on:click="open = false"></div>

        <div class="fixed inset-0 overflow-y-auto p-4 sm:p-6 flex items-end sm:items-center justify-center">
            <div x-cloak x-show="open"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-6 sm:translate-y-4 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95"
                x-show.duration.150ms
                x-on:click.outside="open = false"
                role="dialog" aria-modal="true" aria-labelledby="modal-{{ $name }}-title"
                class="relative w-full {{ $maxWidth }} bg-white rounded-2xl shadow-xl">

                <div class="flex items-start justify-between gap-3 p-5 sm:p-6 border-b border-slate-100">
                    <h2 id="modal-{{ $name }}-title" class="font-headline font-bold text-navy text-base sm:text-lg">
                        {{ $title ?? 'Judul Modal' }}
                    </h2>
                    <button type="button" x-on:click="open = false" aria-label="Tutup modal"
                        class="w-9 h-9 -mr-1.5 -mt-1 rounded-lg flex items-center justify-center text-muted hover:text-navy hover:bg-slate-100 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/60">
                        <x-icon name="x" class="w-5 h-5" />
                    </button>
                </div>

                <div class="p-5 sm:p-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
