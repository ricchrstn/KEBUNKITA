{{-- resources/views/components/article-card.blade.php --}}
@props(['article'])

<div
    {{ $attributes->merge(['class' => 'bg-card/50 backdrop-blur-sm border border-border/50 rounded-xl overflow-hidden flex flex-col group transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-card/80']) }}>

    {{-- Gambar Artikel dengan Overlay Gradient --}}
    <a href="{{ $article['url'] }}" target="_blank" class="relative block">
        <div class="relative h-48 overflow-hidden">
            <img src="{{ $article['urlToImage'] ?? 'https://via.placeholder.com/400x250/e2e8f0/111827?text=Gambar+Tidak+Tersedia' }}"
                alt="Gambar berita tentang {{ $article['title'] }}"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
    </a>

    {{-- Konten Teks Artikel --}}
    <div class="p-6 flex flex-col flex-grow">
        <div class="flex items-center text-xs text-muted-foreground mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            {{ \Carbon\Carbon::parse($article['publishedAt'])->locale('id')->diffForHumans() }}
            @if(isset($article['source']['name']))
                <span class="mx-2">&bull;</span>
                <span>{{ $article['source']['name'] }}</span>
            @endif
        </div>

        <h4 class="font-bold text-lg text-foreground leading-tight group-hover:text-primary transition-colors duration-300">
            <a href="{{ $article['url'] }}" target="_blank">
                {{ $article['title'] }}
            </a>
        </h4>

        <p class="text-muted-foreground text-sm mt-3 flex-grow leading-relaxed">
            {{ \Illuminate\Support\Str::limit($article['description'], 120) }}
        </p>

        <div class="mt-4 pt-4 border-t border-border/30">
            <a href="{{ $article['url'] }}" target="_blank"
                class="text-sm text-primary hover:text-primary/80 font-semibold inline-flex items-center group">
                <span class="group-hover:mr-2 transition-all duration-300">Baca Selengkapnya</span>
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-4 w-4 transform transition-transform duration-300 group-hover:translate-x-1"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>
</div>
