@props(['title' => null])

<!DOCTYPE html>
<html lang="id">
<head>
    <x-site-head :title="$title" />
</head>
<body class="bg-surface text-navy font-sans antialiased">

<main class="min-h-screen w-full flex flex-col lg:flex-row bg-white">

    {{-- SISI KIRI: Form --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-between p-6 sm:p-10 lg:p-12 xl:p-16 min-h-screen overflow-y-auto">
        <header class="flex items-center justify-between w-full mb-8">
            <a href="{{ url('/') }}" aria-label="Kembali ke beranda BugarKu"
                class="flex items-center gap-2 font-headline font-black text-xl tracking-tight focus-visible:ring-2 focus-visible:ring-primary rounded-lg">
                <span class="w-9 h-9 rounded-lg bg-primary text-white flex items-center justify-center shadow-sm">
                    <x-icon name="zap" class="w-5 h-5" />
                </span>
                <span>Bugar<span class="text-primary">Ku</span></span>
            </a>
            <a href="{{ url('/') }}"
                class="inline-flex items-center gap-1.5 min-h-10 px-3.5 py-2 rounded-full text-xs sm:text-sm font-medium text-muted hover:text-navy bg-slate-100 hover:bg-slate-200 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-primary">
                <x-icon name="arrow-left" class="w-4 h-4" />
                Kembali ke Beranda
            </a>
        </header>

        <div class="w-full max-w-md mx-auto my-auto py-6 flex-1">
            <x-toast class="mb-5" />
            {{ $slot }}
        </div>

        <footer class="pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between text-muted text-xs gap-2">
            <span>&copy; {{ date('Y') }} BugarKu Nusantara. Hak cipta dilindungi.</span>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-primary transition">Bantuan</a>
                <a href="#" class="hover:text-primary transition">Panduan</a>
            </div>
        </footer>
    </div>

    {{-- SISI KANAN: Foto motivasi (desktop) --}}
    <div class="hidden lg:flex lg:w-1/2 relative min-h-screen bg-navy overflow-hidden flex-col justify-between p-12 xl:p-16 text-white">
        {{-- Placeholder foto: ganti dengan aset foto lokal di public/images --}}
        {{-- <img src="{{ asset('images/auth-hero.jpg') }}" alt="..." class="absolute inset-0 w-full h-full object-cover"> --}}
        <div class="absolute inset-0 bg-gradient-to-br from-navy via-[#10361f] to-navy"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-primary/20 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 rounded-full bg-accent/15 blur-3xl"></div>

        <div class="relative z-10 flex items-center justify-between gap-4">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/90 text-navy shadow-lg">
                <span class="w-2.5 h-2.5 rounded-full bg-primary animate-pulse"></span>
                <span class="text-xs font-headline font-bold">Komunitas BugarKu</span>
            </div>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-navy/70 backdrop-blur border border-white/10 text-sm">
                <x-icon name="flame" class="w-4 h-4 text-accent" />
                <span class="text-xs sm:text-sm"><strong class="font-bold">12.000+</strong> pemula telah mulai aktif</span>
            </div>
        </div>

        <div class="relative z-10 space-y-8 mt-auto max-w-xl">
            <div>
                <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/20 border border-primary/40 text-primary mb-4">
                    <x-icon name="heart" class="w-5 h-5" />
                </div>
                <blockquote class="font-headline text-2xl xl:text-3xl font-bold leading-snug tracking-tight">
                    &ldquo;Tubuh yang sehat bukan dimulai dari olahraga berat, tapi dari niat kecil yang diulang setiap hari.&rdquo;
                </blockquote>
                <div class="flex items-center gap-3 mt-4">
                    <div class="h-0.5 w-8 bg-primary"></div>
                    <p class="text-sm text-slate-300 font-medium">Coach BugarKu &bull; Master Trainer Pemula</p>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
