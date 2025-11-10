<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Forum Moderation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="space-y-6">
                        @foreach($questions as $question)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $question->title }}</h3>
                                    <p class="text-sm text-gray-500">
                                        Posted by {{ $question->user->name }} • {{ $question->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <form action="{{ route('admin.forum.questions.delete', $question) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus pertanyaan ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>

                            <div class="mt-2">
                                <p class="text-gray-700">{{ $question->content }}</p>
                            </div>

                            {{-- Answers --}}
                            @if($question->answers->count() > 0)
                            <div class="mt-4 pl-6 border-l-2 border-gray-200">
                                <h4 class="text-sm font-semibold text-gray-500 mb-2">{{ $question->answers->count() }} Jawaban</h4>
                                @foreach($question->answers as $answer)
                                <div class="bg-gray-50 rounded p-3 mb-2">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-sm">{{ $answer->content }}</p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $answer->user->name }} • {{ $answer->created_at->diffForHumans() }}
                                                @if($answer->is_best)
                                                <span class="text-green-600 ml-2">✓ Best Answer</span>
                                                @endif
                                            </p>
                                        </div>
                                        <form action="{{ route('admin.forum.answers.delete', $answer) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm" onclick="return confirm('Yakin ingin menghapus jawaban ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>