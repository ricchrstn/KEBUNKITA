{{-- resources/views/home.blade.php --}}
<x-app-layout>
    {{-- Hero Section --}}
    <div class="bg-card border border-border rounded-lg p-6 md:p-8 text-center">
        @auth
            <h2 class="text-3xl font-bold text-foreground">Selamat Datang kembali, {{ Auth::user()->name }}! 🌱</h2>
            <p class="mt-2 text-muted-foreground">Lanjutkan progres Anda dan capai hasil panen terbaik.</p>
            <a href="{{ route('plants.index') }}"
                class="inline-block bg-primary text-primary-foreground font-bold py-3 px-6 rounded-md mt-6 hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ring transition-all duration-300 transform hover:scale-105">
                Tanam Sekarang! 🌾
            </a>
        @else
            <h2 class="text-3xl font-bold text-foreground">Selamat Datang di Sistem Pertanian Modern! 🌱</h2>
            <p class="mt-2 text-muted-foreground max-w-2xl mx-auto">
                Pantau cuaca, baca berita terbaru, dan kelola tanaman Anda dengan lebih baik.
            </p>
            <a href="{{ route('login') }}"
                class="inline-block bg-primary text-primary-foreground font-bold py-3 px-6 rounded-md mt-6 hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ring transition-all duration-300 transform hover:scale-105">
                Mulai Sekarang! 🌾
            </a>
        @endauth
    </div>

    {{-- Statistics Overview --}}
    @auth
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
        {{-- Users Stats --}}
        <div class="bg-card border border-border p-6 rounded-lg">
            <h3 class="text-lg font-semibold text-foreground mb-4">Statistik Pengguna</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-muted-foreground">Total Pengguna</p>
                    <p class="text-2xl font-bold text-primary">{{ $userStats['total_users'] }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Pengguna Baru Hari Ini</p>
                    <p class="text-2xl font-bold text-primary">{{ $userStats['new_users_today'] }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Pengguna Aktif</p>
                    <p class="text-2xl font-bold text-primary">{{ $userStats['active_users'] }}</p>
                </div>
            </div>
        </div>

        {{-- Forum Stats --}}
        <div class="bg-card border border-border p-6 rounded-lg">
            <h3 class="text-lg font-semibold text-foreground mb-4">Statistik Forum</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-muted-foreground">Total Pertanyaan</p>
                    <p class="text-2xl font-bold text-primary">{{ $forumStats['total_questions'] }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Pertanyaan Terjawab</p>
                    <p class="text-2xl font-bold text-primary">{{ $forumStats['answered_questions'] }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Total Jawaban</p>
                    <p class="text-2xl font-bold text-primary">{{ $forumStats['total_answers'] }}</p>
                </div>
            </div>
        </div>

        {{-- Plant Stats --}}
        <div class="bg-card border border-border p-6 rounded-lg">
            <h3 class="text-lg font-semibold text-foreground mb-4">Statistik Tanaman</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-muted-foreground">Total Tanaman</p>
                    <p class="text-2xl font-bold text-primary">{{ $plantStats['total_plants'] }}</p>
                </div>
                <div>
                    <p class="text-muted-foreground">Tanaman Baru (30 hari)</p>
                    <p class="text-2xl font-bold text-primary">{{ $plantStats['active_plants'] }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Section --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        {{-- Questions by Month Chart --}}
        <div class="bg-card border border-border p-6 rounded-lg">
            <h3 class="text-lg font-semibold text-foreground mb-4">Pertanyaan per Bulan</h3>
            <div class="h-64" id="questionsChart"></div>
        </div>

        {{-- Plants by Month Chart --}}
        <div class="bg-card border border-border p-6 rounded-lg">
            <h3 class="text-lg font-semibold text-foreground mb-4">Tanaman Ditanam per Bulan</h3>
            <div class="h-64" id="plantsChart"></div>
        </div>
    </div>

    {{-- Plants by Type Chart --}}
    <div class="bg-card border border-border p-6 rounded-lg mt-8">
        <h3 class="text-lg font-semibold text-foreground mb-4">Distribusi Jenis Tanaman</h3>
        <div class="h-64" id="plantTypesChart"></div>
    </div>
    @endauth

    {{-- Bagian Berita Unggulan --}}
    <div class="mt-12">
        <div class="flex items-center justify-between mb-8">
            <div class="space-y-1">
                <h3 class="text-2xl font-bold text-foreground">Berita Pertanian Unggulan</h3>
                <p class="text-muted-foreground">Informasi terkini seputar dunia pertanian</p>
            </div>
            <a href="{{ route('news.index') }}" 
                class="inline-flex items-center px-4 py-2 rounded-lg bg-primary/10 text-primary hover:bg-primary/20 transition-all duration-200 group">
                <span class="group-hover:mr-2 transition-all duration-300">Lihat Semua</span>
                <svg class="w-5 h-5 transform transition-transform duration-300 group-hover:translate-x-1" 
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($articles as $article)
                <x-article-card :article="$article" />
            @empty
                <div class="md:col-span-3">
                    <div class="bg-card/50 backdrop-blur-sm border border-border/50 rounded-xl p-8 text-center">
                        <svg class="w-16 h-16 mx-auto text-muted-foreground/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-foreground">Tidak ada berita</h3>
                        <p class="mt-2 text-muted-foreground">
                            Tidak dapat memuat berita saat ini. Silakan coba lagi nanti.
                        </p>
                        <button onclick="window.location.reload()" 
                            class="mt-4 inline-flex items-center px-4 py-2 rounded-lg bg-primary/10 text-primary hover:bg-primary/20 transition-all duration-200 group">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            <span class="group-hover:mr-2 transition-all duration-300">Coba Lagi</span>
                        </button>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Questions by Month Chart
        new ApexCharts(document.querySelector("#questionsChart"), {
            chart: {
                type: 'line',
                height: '100%',
                toolbar: { show: false }
            },
            series: [{
                name: 'Pertanyaan',
                data: @json($forumStats['questions_by_month']->pluck('count'))
            }],
            xaxis: {
                categories: @json($forumStats['questions_by_month']->pluck('month'))
            },
            colors: ['#059669'],
            stroke: { curve: 'smooth' }
        }).render();

        // Plants by Month Chart
        new ApexCharts(document.querySelector("#plantsChart"), {
            chart: {
                type: 'line',
                height: '100%',
                toolbar: { show: false }
            },
            series: [{
                name: 'Tanaman',
                data: @json($plantStats['plants_by_month']->pluck('count'))
            }],
            xaxis: {
                categories: @json($plantStats['plants_by_month']->pluck('month'))
            },
            colors: ['#059669'],
            stroke: { curve: 'smooth' }
        }).render();

        // Plants by Type Chart
        new ApexCharts(document.querySelector("#plantTypesChart"), {
            chart: {
                type: 'pie',
                height: '100%'
            },
            series: @json($plantStats['plants_by_type']->pluck('count')),
            labels: @json($plantStats['plants_by_type']->pluck('type')),
            colors: ['#059669', '#34D399', '#6EE7B7', '#A7F3D0'],
        }).render();
    </script>
    @endpush
</x-app-layout>