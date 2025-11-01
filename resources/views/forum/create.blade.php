<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">
            {{ __('Buat Pertanyaan Baru') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-card p-6 rounded-lg border border-border">
                <form action="{{ route('forum.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-medium text-foreground">Judul Pertanyaan</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="mt-1 w-full px-4 py-2 border bg-transparent border-input rounded-md ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-colors @error('title') border-destructive @enderror"
                            placeholder="Contoh: Bagaimana cara mengatasi hama pada tanaman cabai?">
                        @error('title')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-foreground">Detail Pertanyaan</label>
                        <textarea name="content" id="content" rows="8"
                            class="mt-1 w-full px-4 py-2 border bg-transparent border-input rounded-md ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-colors @error('content') border-destructive @enderror"
                            placeholder="Jelaskan pertanyaan Anda secara detail...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a href="{{ route('forum.index') }}"
                            class="text-sm text-muted-foreground hover:text-foreground transition-colors">
                            &larr; Kembali ke Forum
                        </a>
                        <button type="submit"
                            class="inline-flex items-center bg-primary text-primary-foreground font-semibold px-6 py-2 rounded-md hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
                            Posting Pertanyaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>