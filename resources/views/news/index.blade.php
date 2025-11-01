<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-foreground leading-tight">
                {{ __('Berita Pertanian') }}
            </h2>
            <div class="text-sm text-muted-foreground">
                Diperbarui {{ now()->format('d M Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            {{-- Hero Section dengan Background Gradient --}}
            <div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-primary/90 to-primary px-6 py-16 shadow-xl sm:px-12 sm:py-24">
                <div class="relative">
                    <div class="text-center">
                        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-primary-foreground mb-4">
                            Berita Terkini Seputar Pertanian
                        </h1>
                        <p class="text-lg text-primary-foreground/90 max-w-2xl mx-auto">
                            Temukan informasi dan wawasan terbaru dari dunia agrikultur untuk mengembangkan pertanian Anda.
                        </p>
                    </div>

                    {{-- Form Pencarian dengan Animasi --}}
                    <div class="mt-8 max-w-2xl mx-auto">
                        <form action="{{ route('news.index') }}" method="GET"
                            class="group bg-background/10 backdrop-blur-sm hover:bg-background/20 transition-all duration-300 rounded-xl p-2">
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="flex-1 relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3 text-primary-foreground/70" 
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <input type="text" name="search"
                                        placeholder="Cari berita pertanian (contoh: hidroponik, pupuk organik)"
                                        value="{{ $query ?? '' }}"
                                        class="w-full pl-10 pr-4 py-2 bg-transparent border-2 border-primary-foreground/20 text-primary-foreground placeholder:text-primary-foreground/50 rounded-lg focus:border-primary-foreground/40 focus:ring-0 transition-all">
                                </div>
                                <button type="submit"
                                    class="bg-background/20 hover:bg-background/30 text-primary-foreground font-semibold px-6 py-2 rounded-lg transition-all duration-300 flex items-center justify-center group-hover:shadow-lg">
                                    Cari Berita
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Background Pattern --}}
                <div class="absolute inset-0 pointer-events-none opacity-20">
                    <div class="absolute right-0 bottom-0 transform translate-x-1/4 translate-y-1/4">
                        <svg width="400" height="400" viewBox="0 0 100 100" fill="none">
                            <path d="M50 0C77.6142 0 100 22.3858 100 50C100 77.6142 77.6142 100 50 100C22.3858 100 0 77.6142 0 50C0 22.3858 22.3858 0 50 0Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="absolute left-0 top-0 transform -translate-x-1/4 -translate-y-1/4">
                        <svg width="300" height="300" viewBox="0 0 100 100" fill="none">
                            <rect width="100" height="100" rx="20" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Menampilkan Notifikasi Error --}}
            @if (isset($error))
                <div class="px-4 sm:px-0">
                    <div class="bg-destructive/10 backdrop-blur-sm border border-destructive/20 text-destructive-foreground rounded-lg p-4"
                        role="alert">
                        <div class="flex items-start">
                            <svg class="h-6 w-6 text-destructive shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="ml-3">
                                <h3 class="font-semibold">Terjadi Masalah</h3>
                                <p class="mt-1">{{ $error }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Grid Berita dengan Animasi --}}
            @if (!empty($articles))
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-4 sm:px-0">
                    @foreach ($articles as $index => $article)
                        <div class="transform hover:-translate-y-1 transition-all duration-300"
                             style="animation: fadeInUp 0.5s ease-out {{ $index * 0.1 }}s both;">
                            <x-article-card :article="$article" class="h-full" />
                        </div>
                    @endforeach
                </div>
            @elseif(!isset($error))
                {{-- Pesan Tidak Ada Berita dengan Ilustrasi --}}
                <div class="text-center bg-muted/30 backdrop-blur-sm rounded-xl py-16 px-4">
                    <div class="max-w-md mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-muted-foreground mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <p class="text-lg text-muted-foreground">
                            Tidak ada berita yang ditemukan untuk kata kunci 
                            <strong class="text-foreground font-semibold">
                                "{{ $query }}"
                            </strong>
                        </p>
                        <p class="mt-2 text-sm text-muted-foreground">
                            Coba cari dengan kata kunci lain atau kembali lagi nanti.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Animasi CSS --}}
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-app-layout>