@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6">
  <!-- 24h summary -->
  <div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex items-center gap-4">
      <div class="flex items-center gap-4">
        <img src="{{ app(\App\Services\WeatherService::class)->iconUrl($weather['current']['weather']['icon'] ?? '01d') }}" alt="icon" class="w-16 h-16">
        <div>
          <div class="text-lg font-semibold">Cuaca 24 Jam di {{ $weather['city'] ?? '' }}</div>
          <div class="text-sm text-gray-600">Suhu: {{ $weather['min'] ?? '-' }}°C - {{ $weather['max'] ?? '-' }}°C · Jam: {{ $weather['now'] }}</div>
          <a href="#" class="text-sm text-green-600 hover:underline">Klik untuk detail.</a>
        </div>
      </div>
    </div>

    <div class="mt-4 bg-green-50 border border-green-100 p-4 rounded">
      <div class="font-semibold flex items-center gap-2">
        <span class="text-yellow-600">💡</span> Saran Umum:
      </div>
      <div class="text-gray-700 mt-2">
        {{ $weather['suggestion'] }}
      </div>
    </div>
  </div>

  <!-- 3-hour forecast -->
  <div class="bg-white rounded-lg shadow p-6">
    <h3 class="font-semibold mb-4">Prakiraan Per 3 Jam (Arahkan kursor untuk saran):</h3>

    <div class="grid grid-cols-4 md:grid-cols-8 gap-4">
      @foreach($weather['items'] as $item)
        <div x-data class="p-4 bg-gray-50 rounded text-center group relative">
          <div class="text-sm text-gray-500 mb-1">{{ \Carbon\Carbon::createFromTimestampUTC($item['dt'])->format('H:i') }}</div>
          <img src="{{ app(\App\Services\WeatherService::class)->iconUrl($item['weather']['icon'] ?? '01d') }}" alt="" class="mx-auto w-10 h-10">
          <div class="text-sm font-semibold mt-2">{{ $item['temp'] }}°C</div>

          @if($item['pop'] > 0)
          <div class="absolute left-1/2 transform -translate-x-1/2 -bottom-10 hidden group-hover:block w-64 bg-white border rounded p-3 shadow">
            <div class="text-sm font-semibold">Saran</div>
            <div class="text-sm text-gray-700 mt-1">
              @if($item['pop'] >= 0.6)
                Kemungkinan hujan tinggi (~{{ (int)($item['pop']*100) }}%). Tunda penyiraman.
              @elseif($item['pop'] >= 0.3)
                Potensi hujan (~{{ (int)($item['pop']*100) }}%). Pertimbangkan menunda penyiraman.
              @else
                Sedikit kemungkinan hujan (~{{ (int)($item['pop']*100) }}%).
              @endif
            </div>
          </div>
          @endif
        </div>
      @endforeach
    </div>
  </div>

  <!-- Example plant card area (optional) -->
  <div class="mt-6">
    {{-- include a plant card if you have one --}}
  </div>
</div>
@endsection
