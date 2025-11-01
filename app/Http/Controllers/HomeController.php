<?php

// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache; // Import Cache
use Illuminate\Support\Facades\Log;   // Import Log
use Illuminate\Http\Client\RequestException; // Import untuk menangkap error HTTP

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Get latest news
            $articles = Cache::remember('home_articles', 60 * 60, function () {
                $apiKey = config('services.newsapi.key');

                if (!$apiKey) {
                    Log::error('NewsAPI key is not set in config/services.php or .env file.');
                    return [];
                }

                $response = Http::get("https://newsapi.org/v2/everything?q=pertanian&language=id&sortBy=publishedAt&pageSize=3&apiKey=$apiKey");
                $response->throw(); 
                return $response->json()['articles'];
            });
        } catch (\Throwable $e) {
            Log::error('Failed to fetch news: ' . $e->getMessage());
            $articles = [];
        }

        // Get forum statistics
        $forumStats = [
            'total_questions' => \App\Models\Question::count(),
            'answered_questions' => \App\Models\Question::whereHas('answers')->count(),
            'total_answers' => \App\Models\Answer::count(),
            'questions_by_month' => \App\Models\Question::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('count', 'month')
                ->map(function($count, $month) {
                    return [
                        'month' => date('M', mktime(0, 0, 0, $month, 1)),
                        'count' => $count
                    ];
                })->values()
        ];

        // Get plant statistics
        $plantStats = [
            'total_plants' => \App\Models\Plant::count(),
            'active_plants' => \App\Models\Plant::whereDate('planted_at', '>', now()->subDays(30))->count(), // Plants planted in last 30 days
            'plants_by_type' => \App\Models\Plant::selectRaw('type, COUNT(*) as count')
                ->groupBy('type')
                ->get()
                ->map(function($item) {
                    return [
                        'type' => ucfirst($item->type),
                        'count' => $item->count
                    ];
                }),
            'plants_by_month' => \App\Models\Plant::selectRaw('MONTH(planted_at) as month, COUNT(*) as count')
                ->whereYear('planted_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('count', 'month')
                ->map(function($count, $month) {
                    return [
                        'month' => date('M', mktime(0, 0, 0, $month, 1)),
                        'count' => $count
                    ];
                })->values()
        ];

        // Get user stats
        $userStats = [
            'total_users' => \App\Models\User::count(),
            'new_users_today' => \App\Models\User::whereDate('created_at', today())->count(),
            'active_users' => \App\Models\User::has('plants')->count(),
        ];

        return view('home', compact('articles', 'forumStats', 'plantStats', 'userStats'));
    }
}