<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                {{-- Statistics Cards --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm">Total Users</div>
                        <div class="text-3xl font-bold">{{ $stats['total_users'] }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm">Total Plants</div>
                        <div class="text-3xl font-bold">{{ $stats['total_plants'] }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm">Total Questions</div>
                        <div class="text-3xl font-bold">{{ $stats['total_questions'] }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm">Total Answers</div>
                        <div class="text-3xl font-bold">{{ $stats['total_answers'] }}</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Recent Users --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Recent Users</h3>
                        <div class="space-y-4">
                            @foreach($stats['recent_users'] as $user)
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="font-medium">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $user->created_at->diffForHumans() }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Recent Questions --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Recent Forum Questions</h3>
                        <div class="space-y-4">
                            @foreach($stats['recent_questions'] as $question)
                            <div>
                                <div class="font-medium">{{ $question->title }}</div>
                                <div class="text-sm text-gray-500">
                                    by {{ $question->user->name }} • {{ $question->created_at->diffForHumans() }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
