<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class WeatherService
{
    protected $key;
    protected $base = 'https://api.openweathermap.org';

    public function __construct()
    {
        $this->key = config('services.openweather.key') ?: env('OPENWEATHER_API_KEY');
    }

    /**
     * Get 3-hour forecast and a 24h summary for the next 24 hours.
     *
     * @param float $lat
     * @param float $lon
     * @param string $units
     * @param string $lang
     * @return array
     */
    public function forecast3h(float $lat, float $lon, $units = 'metric', $lang = 'id')
    {
        $cacheKey = "weather:forecast:{$lat}:{$lon}:{$units}:{$lang}";

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($lat, $lon, $units, $lang) {
            $url = "{$this->base}/data/2.5/forecast";
            $resp = Http::timeout(10)->get($url, [
                'lat' => $lat,
                'lon' => $lon,
                'units' => $units,
                'lang' => $lang,
                'appid' => $this->key,
            ]);

            if (! $resp->ok()) {
                return [
                    'error' => true,
                    'message' => 'Failed to fetch weather',
                ];
            }

            $data = $resp->json();

            $now = Carbon::now();

            $items = collect($data['list'] ?? [])->map(function ($item) use ($data) {
                return [
                    'dt' => $item['dt'],
                    'time' => Carbon::createFromTimestampUTC($item['dt'])->setTimezone($data['city']['timezone'] ?? config('app.timezone'))->format('H:i'),
                    'temp' => isset($item['main']['temp']) ? round($item['main']['temp']) : null,
                    'temp_min' => isset($item['main']['temp_min']) ? round($item['main']['temp_min']) : null,
                    'temp_max' => isset($item['main']['temp_max']) ? round($item['main']['temp_max']) : null,
                    'pop' => isset($item['pop']) ? $item['pop'] : 0,
                    'weather' => $item['weather'][0] ?? null,
                ];
            })->filter(function ($item) use ($now) {
                $dt = Carbon::createFromTimestampUTC($item['dt']);
                return $dt->greaterThanOrEqualTo($now) && $dt->diffInHours($now) <= 24;
            })->values();

            $min = $items->min('temp_min') ?? null;
            $max = $items->max('temp_max') ?? null;

            $current = $items->first() ?? null;

            $rainSoon = $items->firstWhere('pop', '>=', 0.3);
            $suggestion = 'Tidak ada peringatan hujan untuk 24 jam ke depan.';
            if ($rainSoon) {
                $time = Carbon::createFromTimestampUTC($rainSoon['dt'])->format('H:i');
                $suggestion = "Potensi hujan hari ini, pertama sekitar pukul {$time}. Sebaiknya tunda penyiraman.";
            }

            return [
                'error' => false,
                'city' => $data['city']['name'] ?? null,
                'country' => $data['city']['country'] ?? null,
                'timezone' => $data['city']['timezone'] ?? 0,
                'now' => now()->format('H:i:s'),
                'min' => $min,
                'max' => $max,
                'current' => $current,
                'items' => $items->toArray(),
                'suggestion' => $suggestion,
                'raw' => $data,
            ];
        });
    }

    /**
     * Get OpenWeather icon URL
     */
    public function iconUrl($iconCode, $size = '2x')
    {
        if (! $iconCode) {
            return asset('img/weather/default.png');
        }

        return "https://openweathermap.org/img/wn/{$iconCode}@{$size}.png";
    }
}
