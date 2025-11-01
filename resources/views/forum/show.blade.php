<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">
            {{ __('Detail Pertanyaan') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Pertanyaan --}}
            <div class="bg-card p-6 rounded-lg border border-border">
                <div class="space-y-4">
                    {{-- Judul dan Status --}}
                    <div class="flex items-start justify-between">
                        <h1 class="text-2xl font-bold text-foreground">{{ $question->title }}</h1>
                        @if($question->status === 'closed' || $question->isSolved())
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Terjawab
                            </span>
                        @endif
                    </div>

                    {{-- Metadata --}}
                    <div class="flex items-center space-x-4 text-sm text-muted-foreground">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person me-1" viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6a3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0a2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1s1-4 6-4s6 3 6 4zm-1-.004c-.001.246-.154.986-.832 1.664C11.516 10.68 10.289 11 8 11s-3.516-.32-4.168-1.34c-.678-.678-.831-1.418-.832-1.664z" />
                            </svg>
                            {{ $question->user->name }}
                        </span>
                        <span>{{ $question->created_at->diffForHumans() }}</span>
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-eye me-1" viewBox="0 0 16 16">
                                <path
                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                <path
                                    d="M8 5.5a2.5 2.5 0 1 0 0 5a2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0a3.5 3.5 0 0 1-7 0z" />
                            </svg>
                            {{ $question->views_count }} dilihat
                        </span>
                    </div>

                    {{-- Konten Pertanyaan --}}
                    <div class="prose prose-sm max-w-none">
                        {!! nl2br(e($question->content)) !!}
                    </div>
                </div>
            </div>

            {{-- Jawaban --}}
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">
                    {{ $question->answers->count() }} Jawaban
                </h3>

                @foreach($question->answers as $answer)
                    <div
                        class="bg-card p-6 rounded-lg border {{ $answer->is_best_answer ? 'border-green-500' : 'border-border' }}">
                        {{-- Konten Jawaban --}}
                        <div class="prose prose-sm max-w-none">
                            {!! nl2br(e($answer->content)) !!}
                        </div>

                        {{-- Metadata dan Aksi --}}
                        <div class="mt-4 flex items-center justify-between text-sm">
                            <div class="flex items-center space-x-4 text-muted-foreground">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-person me-1" viewBox="0 0 16 16">
                                        <path
                                            d="M8 8a3 3 0 1 0 0-6a3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0a2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1s1-4 6-4s6 3 6 4zm-1-.004c-.001.246-.154.986-.832 1.664C11.516 10.68 10.289 11 8 11s-3.516-.32-4.168-1.34c-.678-.678-.831-1.418-.832-1.664z" />
                                    </svg>
                                    {{ $answer->user->name }}
                                </span>
                                <span>{{ $answer->created_at->diffForHumans() }}</span>
                            </div>

                            <div class="flex items-center space-x-4">
                                @if($answer->is_best_answer)
                                    <span class="text-green-600 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-check-circle-fill me-1"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                        Jawaban Terbaik
                                    </span>
                                @elseif(auth()->id() === $question->user_id && !$question->isSolved())
                                    <form action="{{ route('answers.mark-best', $answer) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="text-green-600 hover:text-green-700 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-check-circle me-1"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                            </svg>
                                            Pilih Sebagai Jawaban Terbaik
                                        </button>
                                    </form>
                                @endif

                                @if(auth()->id() === $answer->user_id)
                                    <form action="{{ route('answers.destroy', $answer) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-destructive hover:text-destructive/90 flex items-center"
                                            onclick="return confirm('Anda yakin ingin menghapus jawaban ini?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash me-1" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Form Jawaban Baru --}}
                @if(!$question->isSolved())
                    <div class="bg-card p-6 rounded-lg border border-border">
                        <h3 class="text-lg font-semibold mb-4">Berikan Jawaban Anda</h3>
                        <form action="{{ route('questions.answers.store', $question) }}" method="POST"
                            class="space-y-4">
                            @csrf
                            <div>
                                <textarea name="content" rows="4"
                                    class="w-full px-4 py-2 border bg-transparent border-input rounded-md ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-colors @error('content') border-destructive @enderror"
                                    placeholder="Tulis jawaban Anda di sini...">{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit"
                                class="inline-flex items-center bg-primary text-primary-foreground font-semibold px-6 py-2 rounded-md hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
                                Kirim Jawaban
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>