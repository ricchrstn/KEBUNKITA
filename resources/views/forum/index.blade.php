<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">
            {{ __('Forum Komunitas') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            {{-- Header, Deskripsi, dan Tombol --}}
            <div class="text-center px-4">
                <div class="flex flex-col items-center">
                    <h1 class="text-4xl font-bold text-foreground">Forum Tanya Jawab KebunKita</h1>
                    <p class="mt-2 text-lg text-muted-foreground mb-6">
                        Diskusikan pertanyaan seputar pertanian dan berbagi pengalaman dengan sesama petani.
                    </p>
                    <a href="{{ route('forum.create') }}"
                        class="inline-flex items-center bg-primary text-primary-foreground font-semibold px-6 py-3 rounded-md hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-lg me-2" viewBox="0 0 16 16">
                            <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 1 1 0-2h6V1a1 1 0 0 1 1-1z" />
                        </svg>
                        Ajukan Pertanyaan
                    </a>
                </div>
            </div>

            {{-- Form Pencarian --}}
            <div class="px-4 sm:px-0">
                <form action="{{ route('forum.index') }}" method="GET"
                    class="flex flex-col sm:flex-row gap-3 max-w-2xl mx-auto">
                    <input type="text" name="search" placeholder="Cari pertanyaan... (contoh: hidroponik, hama)"
                        value="{{ $query ?? '' }}"
                        class="w-full px-4 py-2 border bg-transparent border-input rounded-md ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-colors">
                    <button type="submit"
                        class="inline-flex items-center justify-center bg-primary text-primary-foreground font-semibold px-6 py-2 rounded-md hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search me-2" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.414 1.414l3.85 3.85a1 1 0 0 0 1.414-1.414l-3.85-3.85zM2 6.5a4.5 4.5 0 1 1 9 0a4.5 4.5 0 0 1-9 0z" />
                        </svg>
                        Cari
                    </button>
                </form>
            </div>

            {{-- Daftar Pertanyaan --}}
            @if($questions->isNotEmpty())
                <div class="space-y-4">
                    @foreach($questions as $question)
                        <div class="bg-card p-6 rounded-lg border border-border hover:border-border/80 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold">
                                        <a href="{{ route('forum.show', $question) }}"
                                            class="hover:text-primary transition-colors">
                                            {{ $question->title }}
                                        </a>
                                    </h3>
                                    <p class="mt-2 text-muted-foreground line-clamp-2">
                                        {{ Str::limit(strip_tags($question->content), 200) }}
                                    </p>
                                    <div class="mt-4 flex items-center space-x-4 text-sm text-muted-foreground">
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person me-1" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 8a3 3 0 1 0 0-6a3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0a2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1s1-4 6-4s6 3 6 4zm-1-.004c-.001.246-.154.986-.832 1.664C11.516 10.68 10.289 11 8 11s-3.516-.32-4.168-1.34c-.678-.678-.831-1.418-.832-1.664z" />
                                            </svg>
                                            {{ $question->user->name }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-chat-dots me-1" viewBox="0 0 16 16">
                                                <path
                                                    d="M5 8a1 1 0 1 1-2 0a1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0z" />
                                                <path
                                                    d="M2.678 11.894a1 1 0 0 1 .287.801a10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6S1 3.993 1 7a6.98 6.98 0 0 0 .944 3.607a1 1 0 0 1 .287.81z" />
                                            </svg>
                                            {{ $question->answers_count ?? 0 }} Jawaban
                                        </span>
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye me-1" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5a2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0a3.5 3.5 0 0 1-7 0z" />
                                            </svg>
                                            {{ $question->views_count }} dilihat
                                        </span>
                                        <span>{{ $question->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                @if($question->status === 'closed' || $question->isSolved())
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Terjawab
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $questions->links() }}
                </div>
            @else
                {{-- Pesan jika tidak ada pertanyaan --}}
                <div class="text-center bg-muted/50 rounded-lg py-16">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                        class="bi bi-chat-square-text mx-auto text-muted-foreground mb-4" viewBox="0 0 16 16">
                        <path
                            d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333L6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                        <path
                            d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                    </svg>
                    @if($query)
                        <p class="text-muted-foreground">Tidak ada pertanyaan yang ditemukan untuk kata kunci <strong
                                class="text-foreground">"{{ $query }}"</strong>.</p>
                    @else
                        <p class="text-muted-foreground">Belum ada pertanyaan yang diajukan.</p>
                    @endif
                    <div class="mt-4">
                        <a href="{{ route('forum.create') }}"
                            class="inline-flex items-center bg-primary text-primary-foreground font-semibold px-6 py-2 rounded-md hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
                            Ajukan Pertanyaan Pertama
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>