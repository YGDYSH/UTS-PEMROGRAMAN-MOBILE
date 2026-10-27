@props([
    'title' => null,
    'mode' => 'user', // 'user' | 'admin'
])

<div class="min-h-screen bg-surface text-navy font-sans antialiased"
    x-data="{ drawerOpen: false }">

    @php
        if ($mode === 'admin') {
            $menu = [
                ['label' => 'Dashboard', 'href' => url('/admin'), 'icon' => 'home', 'match' => 'admin'],
                ['label' => 'Latihan', 'href' => url('/admin/exercises'), 'icon' => 'dumbbell', 'match' => 'admin/exercises'],
                ['label' => 'Alat', 'href' => url('/admin/equipment'), 'icon' => 'list', 'match' => 'admin/equipment'],
                ['label' => 'Kondisi', 'href' => url('/admin/conditions'), 'icon' => 'stethoscope', 'match' => 'admin/conditions'],
                ['label' => 'Kutipan', 'href' => url('/admin/quotes'), 'icon' => 'heart', 'match' => 'admin/quotes'],
                ['label' => 'Pengguna', 'href' => url('/admin/users'), 'icon' => 'user', 'match' => 'admin/users'],
            ];
            $tabs = $menu;
            $adminBadge = 'ADMIN';
        } else {
            $menu = [
                ['label' => 'Dashboard', 'href' => url('/dashboard'), 'icon' => 'home', 'match' => 'dashboard'],
                ['label' => 'Program', 'href' => url('/programs'), 'icon' => 'dumbbell', 'match' => 'programs'],
                ['label' => 'Riwayat', 'href' => url('/workout-logs'), 'icon' => 'activity', 'match' => 'workout-logs'],
                ['label' => 'Progres', 'href' => url('/progress'), 'icon' => 'bar-chart', 'match' => 'progress'],
                ['label' => 'Rekomendasi', 'href' => url('/recommendations'), 'icon' => 'target', 'match' => 'recommendations'],
                ['label' => 'Nutrisi', 'href' => url('/nutrition'), 'icon' => 'utensils', 'match' => 'nutrition'],
                ['label' => 'Profil', 'href' => url('/profile'), 'icon' => 'user', 'match' => 'profile'],
            ];
            $tabs = [
                ['label' => 'Home', 'href' => url('/dashboard'), 'icon' => 'home', 'match' => 'dashboard'],
                ['label' => 'Program', 'href' => url('/programs'), 'icon' => 'dumbbell', 'match' => 'programs'],
                ['label' => 'Progres', 'href' => url('/progress'), 'icon' => 'bar-chart', 'match' => 'progress'],
                ['label' => 'Profil', 'href' => url('/profile'), 'icon' => 'user', 'match' => 'profile'],
            ];
            $adminBadge = null;
        }

        $isActive = fn (array $item) => request()->is($item['match']) || str_starts_with(request()->path(), $item['match']);
    @endphp

    {{-- SIDEBAR DESKTOP (navy) --}}
    <aside class="hidden lg:flex flex-col fixed inset-y-0 left-0 w-64 bg-navy text-white z-40" aria-label="Menu utama">
        <div class="px-5 py-5 flex items-center justify-between">
            <a href="{{ $mode === 'admin' ? url('/admin') : url('/dashboard') }}"
                class="flex items-center gap-2 font-headline font-black text-lg tracking-tight">
                <span class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center shadow">
                    <x-icon name="zap" class="w-4.5 h-4.5" />
                </span>
                <span>Bugar<span class="text-primary">Ku</span></span>
            </a>
            @if ($adminBadge)
                <span class="px-2 py-0.5 rounded-md bg-accent text-[10px] font-headline font-bold uppercase tracking-wider">{{ $adminBadge }}</span>
            @endif
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            @foreach ($menu as $item)
                <a href="{{ $item['href'] }}"
                    @class([
                        'min-h-11 px-3 py-2.5 rounded-xl flex items-center gap-3 text-sm font-medium transition',
                        'bg-primary/90 text-white font-semibold' => $isActive($item),
                        'text-slate-300 hover:text-white hover:bg-white/10' => ! $isActive($item),
                    ])
                    @if ($isActive($item)) aria-current="page" @endif>
                    <x-icon :name="$item['icon']" class="w-5 h-5 shrink-0" />
                    {{ $item['label'] }}
                    <x-icon name="chevron-right" class="w-4 h-4 ml-auto opacity-60" />
                </a>
            @endforeach
        </nav>

        <div class="p-4 border-t border-white/10">
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full min-h-11 px-3 py-2.5 rounded-xl flex items-center gap-3 text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-primary">
                    <x-icon name="log-out" class="w-5 h-5" />
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- KONTEN --}}
    <div class="lg:pl-64 min-h-screen flex flex-col">

        {{-- TOP BAR --}}
        <header class="sticky top-0 z-30 bg-white/90 backdrop-blur border-b border-slate-100">
            <div class="h-16 px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-3">
                <div class="flex items-center gap-3 min-w-0">
                    {{-- Logo mobile --}}
                    <a href="{{ $mode === 'admin' ? url('/admin') : url('/dashboard') }}" class="lg:hidden flex items-center gap-1.5 font-headline font-black text-base">
                        <span class="w-7 h-7 rounded-lg bg-primary flex items-center justify-center">
                            <x-icon name="zap" class="w-4 h-4" />
                        </span>
                        Bugar<span class="text-primary -ml-1">Ku</span>
                    </a>
                    <div class="hidden lg:block truncate">
                        <h1 class="font-headline font-bold text-navy text-base sm:text-lg truncate">{{ $title ?? 'BugarKu' }}</h1>
                    </div>
                    @if ($adminBadge)
                        <span class="hidden sm:inline-flex px-2 py-0.5 rounded-md bg-accent text-[10px] font-headline font-bold text-white uppercase tracking-wider">{{ $adminBadge }}</span>
                    @endif
                </div>

                <div class="flex items-center gap-2 sm:gap-3">
                    {{-- Toolbar atas (avatar + tombol keluar) --}}
                    <div class="hidden sm:block text-xs text-muted">{{ $pageTitle ?? '' }}</div>
                    <button type="button" x-on:click="drawerOpen = !drawerOpen"
                        class="lg:hidden w-10 h-10 rounded-xl flex items-center justify-center text-navy hover:bg-slate-100 transition"
                        aria-label="Info akun">
                        <span class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-headline font-bold text-sm">
                            {{ strtoupper(substr(auth()->user()->name ?? 'B', 0, 1)) }}
                        </span>
                    </button>
                    <div class="hidden lg:flex items-center gap-2.5" x-data="{ open: false }">
                        <span class="w-9 h-9 rounded-full bg-primary text-white flex items-center justify-center font-headline font-bold text-sm"
                            aria-hidden="true">
                            {{ strtoupper(substr(auth()->user()->name ?? 'B', 0, 1)) }}
                        </span>
                        <span class="text-sm text-navy font-medium max-w-40 truncate">{{ auth()->user()->name ?? 'Pengguna' }}</span>
                        <form action="{{ url('/logout') }}" method="POST">
                            @csrf
                            <button type="submit" title="Keluar"
                                class="w-10 h-10 rounded-xl flex items-center justify-center text-muted hover:text-danger hover:bg-danger/10 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-danger/50"
                                aria-label="Keluar">
                                <x-icon name="log-out" class="w-5 h-5" />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="lg:hidden px-4 pb-3">
                <h1 class="font-headline font-bold text-navy text-base truncate">{{ $title ?? 'BugarKu' }}</h1>
            </div>
        </header>

        {{-- Info akun mobile drawer --}}
        <div x-cloak x-show="drawerOpen" x-on:click.outside="drawerOpen = false"
            class="lg:hidden fixed top-16 inset-x-0 z-20 bg-white border-b border-slate-100 shadow-soft">
            <div class="p-4 flex items-center gap-3">
                <span class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-headline font-bold">{{ strtoupper(substr(auth()->user()->name ?? 'B', 0, 1)) }}</span>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-navy truncate">{{ auth()->user()->name ?? 'Pengguna' }}</p>
                    <p class="text-xs text-muted truncate">{{ auth()->user()->email ?? 'serigala@bugarku.id' }}</p>
                </div>
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="min-h-11 px-4 rounded-button border border-slate-300 text-sm font-medium text-navy hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-danger/50">
                        Keluar
                    </button>
                </form>
            </div>
        </div>

        {{-- AREA KONTEN --}}
        <main class="flex-1 px-4 sm:px-6 lg:px-8 py-4 sm:py-6 pb-24 lg:pb-8">
            <x-toast class="mb-4" />
            {{ $slot }}
        </main>

        {{-- COPYRIGHT kecil di bawah --}}
        <div class="hidden lg:block text-center text-[11px] text-muted pb-4">
            &copy; {{ date('Y') }} BugarKu &bull; Semua data latihan hanya kamu yang bisa melihat.
        </div>
    </div>

    {{-- BOTTOM TAB BAR MOBILE --}}
    <nav class="lg:hidden fixed bottom-0 inset-x-0 z-40 bg-white border-t border-slate-100 shadow-[0_-4px_16px_rgba(15,23,42,0.06)]"
        aria-label="Navigasi utama mobile">
        <div class="grid grid-cols-4 max-w-lg mx-auto">
            @foreach ($tabs as $tab)
                <a href="{{ $tab['href'] }}"
                    @class([
                        'min-h-16 flex flex-col items-center justify-center gap-1 text-[10px] font-headline font-semibold transition',
                        'text-primary' => $isActive($tab),
                        'text-muted hover:text-navy' => ! $isActive($tab),
                    ])
                    @if ($isActive($tab)) aria-current="page" @endif>
                    <x-icon :name="$tab['icon']" class="w-5.5 h-5.5" />
                    {{ $tab['label'] }}
                </a>
            @endforeach
        </div>
    </nav>
</div>
