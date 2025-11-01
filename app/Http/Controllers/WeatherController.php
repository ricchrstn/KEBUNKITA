<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected $weather;

    public function __construct(WeatherService $weather)
    {
        $this->weather = $weather;
    }

    public function show(Request $request)
    {
        $lat = $request->input('lat', -6.2146); // Jakarta
        $lon = $request->input('lon', 106.8451);

        $data = $this->weather->forecast3h((float)$lat, (float)$lon, 'metric', 'id');

        if (isset($data['error']) && $data['error']) {
            return view('weather.error', ['message' => $data['message'] ?? 'Weather unavailable']);
        }

        return view('weather.show', [
            'weather' => $data,
            'lat' => $lat,
            'lon' => $lon,
        ]);
    }
}
