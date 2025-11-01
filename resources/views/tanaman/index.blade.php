<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight flex items-center gap-2">
            🌾 Tanaman Saya
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- FORM TAMBAH TANAMAN --}}
            <div class="bg-card p-8 rounded-2xl border border-border shadow-md hover:shadow-lg transition-all">
                <h3 class="text-lg font-semibold text-foreground mb-4 flex items-center gap-2">
                    🌱 Tambah Tanaman Baru
                </h3>

                <form action="{{ route('plants.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Nama/Label Tanaman')" />
                        <x-text-input type="text" name="name" id="name" class="w-full"
                            placeholder="Contoh: Padi Sawah Belakang" required />
                    </div>

                    <div>
                        <x-input-label for="type" :value="__('Jenis Tanaman')" />
                        <select name="type" id="type"
                            class="w-full border-input bg-background rounded-md focus:ring-2 focus:ring-primary/50 transition">
                            <option value="padi">Padi (±90 Hari)</option>
                            <option value="jagung">Jagung (±85 Hari)</option>
                            <option value="cabai">Cabai (±100 Hari)</option>
                            <option value="tomat">Tomat (±75 Hari)</option>
                            <option value="terong">Terong (±95 Hari)</option>
                            <option value="kacang_tanah">Kacang Tanah (±110 Hari)</option>
                            <option value="mentimun">Mentimun (±60 Hari)</option>
                            <option value="bawang_merah">Bawang Merah (±80 Hari)</option>
                        </select>
                    </div>

                    <div class="md:col-span-2 flex justify-end">
                        <x-primary-button class="w-full md:w-auto px-6 py-3 flex items-center justify-center gap-2 text-base">
                            <x-icon name="plus-circle" class="w-5 h-5" />
                            Tambahkan Tanaman
                        </x-primary-button>
                    </div>
                </form>
            </div>

            {{-- CUACA INTERAKTIF --}}
            @if ($weather)
                <details class="bg-card border border-border rounded-2xl shadow-md group" open>
                    <summary class="p-5 flex items-center justify-between cursor-pointer">
                                                <div class="flex items-center gap-4">
                            @if ($weather['summary']['dominant_weather'])
                                <img src="https://openweathermap.org/img/wn/{{ $weather['summary']['dominant_weather']['icon'] }}@2x.png" 
                                     alt="Weather" 
                                     class="w-12 h-12"
                                />
                            @endif
                            <div>
                                <h4 class="font-bold text-lg text-foreground">Cuaca 24 Jam di
                                    {{ $weather['city_name'] }}</h4>
                                {{-- ✅ PENAMBAHAN JAM REAL-TIME --}}
                                <div class="flex items-center gap-2 text-muted-foreground text-sm">
                                    <span>Suhu: {{ $weather['summary']['min_temp'] }}°C -
                                        {{ $weather['summary']['max_temp'] }}°C</span>
                                    <span class="font-bold">·</span>
                                    <span id="current-time-display" class="font-semibold text-foreground"></span>
                                </div>
                                <span class="text-primary font-medium">Klik untuk detail.</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition-transform group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>

                    <div class="border-t border-border p-5 space-y-4">
                        <div class="bg-accent/40 text-accent-foreground p-4 rounded-md">
                            <p class="font-bold">💡 Rekomendasi Hari Ini:</p>
                            @if ($weather['summary']['will_rain'])
                                <p>Akan turun hujan sekitar pukul
                                    {{ \Carbon\Carbon::parse($weather['summary']['rain_time'])->format('H:i') }}.
                                    Tunda penyiraman tanaman hari ini.</p>
                            @elseif ($weather['summary']['max_temp'] > 32)
                                <p>Cuaca panas ekstrem, pastikan tanaman cukup air sore nanti. ☀️</p>
                            @else
                                <p>Cuaca stabil, kondisi ideal untuk pertumbuhan tanaman. 🌿</p>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-8 gap-3">
                            @foreach ($weather['list'] as $forecast)
                                <div class="relative bg-muted/50 rounded-md p-3 text-center hover:bg-muted/80 transition forecast-block">
                                    <p class="text-sm font-semibold text-foreground">
                                        {{ \Carbon\Carbon::parse($forecast['dt_txt'])->format('H:i') }}
                                    </p>
                                                                    <div
                                        class="mx-auto my-1 w-12 h-12 flex items-center justify-center bg-background/50 rounded-full">
                                        <img src="https://openweathermap.org/img/wn/{{ $forecast['weather'][0]['icon'] }}@2x.png" 
                                             alt="Weather"
                                             class="w-12 h-12"
                                        />
                                    <p class="text-sm text-muted-foreground">
                                        {{ round($forecast['main']['temp']) }}°C
                                    </p>

                                    {{-- Tooltip --}}
                                    <div class="forecast-tooltip absolute bottom-full mb-2 w-44 left-1/2 -translate-x-1/2 p-2 bg-foreground text-background text-xs rounded-md shadow-lg opacity-0 invisible transition-opacity duration-300 pointer-events-none">
                                        {{ $forecast['weather'][0]['description'] }}
                                        <div class="absolute top-full left-1/2 -translate-x-1/2 w-0 h-0 border-x-4 border-x-transparent border-t-4 border-t-foreground"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </details>
            @endif

            {{-- GRID TANAMAN --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($plants as $plant)
                    <x-plant-card :plant="$plant" />
                @empty
                    <div class="col-span-full bg-muted/40 p-12 text-center rounded-lg">
                        <p class="text-muted-foreground">Belum ada tanaman. Tambahkan tanaman pertama Anda! 🌻</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const timeDisplay = document.getElementById('current-time-display');
                function updateTime() {
                    if (timeDisplay) {
                        const now = new Date();
                        const timeString = now.toLocaleTimeString('id-ID', {
                            hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false
                        });
                        timeDisplay.textContent = `Jam: ${timeString}`;
                    }
                }
                updateTime();
                setInterval(updateTime, 1000);

                // Tooltip interaktif
                const forecastBlocks = document.querySelectorAll('.forecast-block');
                forecastBlocks.forEach(block => {
                    const tooltip = block.querySelector('.forecast-tooltip');
                    block.addEventListener('mouseenter', () => {
                        tooltip.classList.remove('invisible', 'opacity-0');
                        tooltip.classList.add('opacity-100');
                    });
                    block.addEventListener('mouseleave', () => {
                        tooltip.classList.remove('opacity-100');
                        tooltip.classList.add('invisible', 'opacity-0');
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
