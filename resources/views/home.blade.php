{{-- resources/views/home.blade.php --}}
<x-app-layout>
    {{-- Hero Section --}}
    <div class="relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-card/95 backdrop-blur-sm border border-border rounded-2xl p-8 md:p-12 text-center">
                @auth
                    <h2 class="text-4xl font-bold text-foreground bg-clip-text text-transparent bg-gradient-to-r from-primary to-primary/70">
                        Selamat Datang kembali, {{ Auth::user()->name }}! 🌱
                    </h2>
                    <p class="mt-4 text-lg text-muted-foreground">
                        Lanjutkan progres Anda dan capai hasil panen terbaik.
                    </p>
                    <div class="mt-8">
                        <a href="{{ route('plants.index') }}"
                            class="inline-flex items-center bg-primary text-primary-foreground font-semibold py-3 px-8 rounded-xl hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ring transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                            <span>Tanam Sekarang!</span>
                            <span class="ml-2">🌾</span>
                        </a>
                    </div>
                @else
                    <div class="max-w-3xl mx-auto">
                        <h2 class="text-4xl md:text-5xl font-bold text-foreground bg-clip-text text-transparent bg-gradient-to-r from-primary to-primary/70">
                            Masa Depan Pertanian Ada di Tangan Anda! 🌱
                        </h2>
                        <p class="mt-6 text-lg text-muted-foreground leading-relaxed">
                            KebunKita hadir untuk membantu Anda mengelola pertanian dengan lebih modern dan efisien. 
                            Pantau cuaca, dapatkan wawasan, dan tingkatkan hasil panen Anda.
                        </p>
                        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <a href="{{ route('login') }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center bg-primary text-primary-foreground font-semibold py-3 px-8 rounded-xl hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ring transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                                <span>Mulai Sekarang</span>
                                <span class="ml-2">🌾</span>
                            </a>
                            <a href="{{ route('register') }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center bg-card border border-border text-foreground font-semibold py-3 px-8 rounded-xl hover:bg-card/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ring transition-all duration-300 transform hover:-translate-y-1">
                                <span>Daftar Gratis</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
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