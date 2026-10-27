@props(['title' => null, 'transparent' => false])

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <x-site-head :title="$title" />
</head>
<body class="bg-surface text-navy font-sans antialiased min-h-screen">

{{-- Navbar: transparan overlay (untuk hero) atau solid sticky --}}
<header @class([
        'fixed inset-x-0 top-0 z-40 bg-navy/0 text-white' => $transparent,
        'sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-slate-100 text-navy' => ! $transparent,
    ])>
    <nav class="max-w-6xl lg:max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 lg:h-18 flex items-center justify-between gap-4"
        x-data="{ menuOpen: false }">
        {{-- Logo --}}
        <a href="#" class="flex items-center gap-2 font-headline font-black text-lg sm:text-xl tracking-tight">
            <span class="w-8 h-8 rounded-lg bg-primary text-white flex items-center justify-center shadow-sm">
                <x-icon name="zap" class="w-4.5 h-4.5" />
            </span>
            <span>Bugar<span class="text-primary">Ku</span></span>
        </a>

        {{-- Link desktop --}}
        <div class="hidden md:flex items-center gap-6 text-[12px] font-headline font-semibold tracking-widest uppercase">
            <a href="#fitur" @class(['opacity-80 hover:opacity-100 transition'])>Fitur</a>
            <a href="#program" class="text-primary font-bold flex items-center gap-1">Program
                <span class="w-1.5 h-1.5 rounded-full bg-primary inline-block"></span>
            </a>
            <a href="#cara-kerja" @class(['opacity-80 hover:opacity-100 transition'])>Cara Kerja</a>
            <a href="{{ url('/kalkulator-bmi') }}" @class(['hover:text-accent transition'])>Kalkulator BMI</a>
        </div>

        {{-- Aksi kanan --}}
        <div class="flex items-center gap-3 sm:gap-5">
            <a href="#" class="hidden sm:inline-flex text-[13px] font-headline font-semibold opacity-90 hover:opacity-100 transition">Masuk</a>
            @guest
                <a href="{{ url('/register') }}"
                    class="inline-flex items-center gap-1.5 min-h-10 px-4 py-2 rounded-full text-xs sm:text-sm font-headline font-bold {{ $transparent ? 'bg-white text-navy' : 'bg-primary text-white' }} hover:opacity-90 transition shadow-sm">
                    Daftar Gratis
                </a>
            @endguest
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="inline-flex items-center gap-1.5 min-h-10 px-4 py-2 rounded-full text-xs sm:text-sm font-headline font-bold {{ $transparent ? 'bg-white text-navy' : 'bg-primary text-white' }} hover:opacity-90 transition shadow-sm">
                    Dashboard
                </a>
            @endauth

            {{-- Hamburger mobile --}}
            <button type="button" x-on:click="menuOpen = !menuOpen" aria-label="Buka menu"
                aria-expanded="false" x-bind:aria-expanded="menuOpen.toString()"
                class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg {{ $transparent ? 'text-white' : 'text-navy' }} hover:opacity-75 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary">
                <x-icon name="menu" class="w-6 h-6" />
            </button>
        </div>

        {{-- Menu mobile dropdown --}}
        <div x-cloak x-show="menuOpen" x-on:click.outside="menuOpen = false"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="absolute top-full inset-x-4 mt-2 rounded-2xl bg-white text-navy shadow-xl border border-slate-100 p-4 md:hidden">
            <div class="flex flex-col gap-1 text-sm font-headline font-semibold">
                <a href="#fitur" x-on:click="menuOpen = false" class="min-h-11 flex items-center px-3 rounded-xl hover:bg-slate-100 transition">Fitur</a>
                <a href="#program" x-on:click="menuOpen = false" class="min-h-11 flex items-center px-3 rounded-xl hover:bg-slate-100 transition">Program</a>
                <a href="#cara-kerja" x-on:click="menuOpen = false" class="min-h-11 flex items-center px-3 rounded-xl hover:bg-slate-100 transition">Cara Kerja</a>
                <a href="{{ url('/kalkulator-bmi') }}" x-on:click="menuOpen = false" class="min-h-11 flex items-center px-3 rounded-xl hover:bg-slate-100 transition">Kalkulator BMI</a>
                @guest
                    <div class="grid grid-cols-2 gap-2 pt-2 mt-2 border-t border-slate-100">
                        <a href="{{ url('/login') }}" class="min-h-11 flex items-center justify-center rounded-button border border-slate-300 text-navy hover:bg-slate-50 transition">Masuk</a>
                        <a href="{{ url('/register') }}" class="min-h-11 flex items-center justify-center rounded-button bg-primary text-white hover:bg-primary-dark transition">Daftar</a>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
</header>

{{-- Konten halaman --}}
<main @class([
        'pt-16' => $transparent,
    ])>
    {{ $slot }}
</main>

{{-- Footer navy --}}
<footer class="mt-8 bg-navy text-white">
    <div class="max-w-6xl lg:max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 pb-8 border-b border-slate-800">
            {{-- Brand --}}
            <div class="md:col-span-5">
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white">
                        <x-icon name="zap" class="w-4.5 h-4.5" />
                    </span>
                    <span class="font-headline font-black text-xl tracking-tight">Bugar<span class="text-primary">Ku</span></span>
                </div>
                <p class="text-slate-400 text-xs sm:text-sm max-w-sm leading-relaxed">
                    Platform kebugaran &amp; hidup sehat untuk pemula Indonesia. Membangun kebiasaan olahraga yang
                    konsisten, aman, dan tanpa rasa intimidasi.
                </p>
            </div>
            {{-- Navigasi --}}
            <div class="md:col-span-3">
                <h4 class="font-headline font-bold text-xs uppercase tracking-wider text-slate-300 mb-3">Eksplorasi</h4>
                <ul class="space-y-2 text-xs font-headline text-slate-400">
                    <li><a class="hover:text-white transition" href="#program">Program Latihan</a></li>
                    <li><a class="hover:text-white transition" href="#cara-kerja">Cara Kerja</a></li>
                    <li><a class="hover:text-white transition" href="{{ url('/kalkulator-bmi') }}">Kalkulator BMI</a></li>
                    <li><a class="hover:text-white transition" href="{{ url('/register') }}">Daftar Gratis</a></li>
                </ul>
            </div>
            {{-- Disclaimer --}}
            <div class="md:col-span-4">
                <h4 class="font-headline font-bold text-xs uppercase tracking-wider text-slate-300 mb-3">Catatan Kesehatan Penting</h4>
                <x-health-disclaimer class="text-xs" />
            </div>
        </div>
        <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px] text-slate-500 font-headline">
            <p>&copy; {{ date('Y') }} BugarKu Indonesia. Semua hak dilindungi.</p>
            <p>Dibuat untuk langkah kebugaran pertama masyarakat Indonesia.</p>
        </div>
    </div>
</footer>

</body>
</html>
