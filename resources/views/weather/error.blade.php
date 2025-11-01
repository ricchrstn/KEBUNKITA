@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
  <div class="bg-white rounded shadow p-6">
    <h2 class="text-lg font-semibold">Cuaca tidak tersedia</h2>
    <p class="mt-4 text-gray-700">{{ $message ?? 'Data cuaca saat ini tidak dapat diambil. Silakan coba beberapa saat lagi.' }}</p>
  </div>
</div>
@endsection
