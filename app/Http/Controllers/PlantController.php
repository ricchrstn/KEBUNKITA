<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PlantController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $plants = $user->plants()->orderBy('planted_at', 'desc')->get();
        $weatherForecast = null;

        $apiKey = config('services.openweather.key');

        // Hanya ambil data cuaca jika lokasi user tersedia
        if ($user->location && $apiKey) {
            $response = Http::get("https://api.openweathermap.org/data/2.5/forecast?q={$user->location}&lang=id&appid={$apiKey}&units=metric");

            if ($response->successful()) {
                $weatherData = $response->json();
                $forecasts_24h = array_slice($weatherData['list'], 0, 8);

                $temps = array_column(array_column($forecasts_24h, 'main'), 'temp');
                $will_rain = false;
                $rain_time = null;
                $dominant_weather = null;

                foreach ($forecasts_24h as $forecast) {
                    if (str_starts_with((string) $forecast['weather'][0]['id'], '5')) {
                        $will_rain = true;
                        if (!$rain_time) {
                            $rain_time = $forecast['dt_txt'];
                        }
                    }
                }

                if (isset($forecasts_24h[2])) {
                    $dominant_weather = $forecasts_24h[2]['weather'][0];
                }

                $weatherForecast = [
                    'city_name' => $weatherData['city']['name'],
                    'list' => $forecasts_24h,
                    'summary' => [
                        'min_temp' => round(min($temps)),
                        'max_temp' => round(max($temps)),
                        'will_rain' => $will_rain,
                        'rain_time' => $rain_time,
                        'dominant_weather' => $dominant_weather,
                    ],
                ];
            }
        }

        return view('tanaman.index', [
            'plants' => $plants,
            'weather' => $weatherForecast,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
        ]);

        $request->user()->plants()->create([
            'name' => $request->name,
            'type' => $request->type,
            'planted_at' => now(),
        ]);

        return redirect()->route('plants.index')->with('success', 'Tanaman berhasil ditambahkan!');
    }

    public function destroy(Plant $plant)
    {
        $this->authorize('delete', $plant);
        $plant->delete();
        return redirect()->route('plants.index')->with('status', 'Tanaman berhasil dihapus.');
    }
}
