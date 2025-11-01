<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class NewsController extends Controller
{
    /**
     * Menampilkan halaman daftar berita.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil API key dari file .env.
        $apiKey = env('NEWS_API_KEY');

        if (!$apiKey) {
            Log::error('NEWS_API_KEY not set in .env file.');
            return view('news.index', [
                'articles' => [],
                'error' => 'Konfigurasi API berita belum diatur. Silakan hubungi administrator.'
            ]);
        }
        
        // Tentukan kata kunci pencarian
        $searchQuery = $request->input('search', 'pertanian');

        // Lakukan panggilan ke NewsAPI
        $response = Http::get('https://newsapi.org/v2/everything', [
            'q' => $searchQuery,
            'language' => 'id',
            'sortBy' => 'publishedAt',
            'apiKey' => $apiKey,
            'pageSize' => 12
        ]);

        $articles = [];
        $error = null;

        if ($response->successful()) {
            $data = $response->json();
            if ($data['status'] === 'ok') {
                $articles = $data['articles'];
            } else {
                $error = 'Terjadi kesalahan saat mengambil data berita.';
                Log::error('NewsAPI returned error: ' . json_encode($data));
            }
        } else {
            $error = 'Tidak dapat terhubung ke layanan berita.';
            Log::error('NewsAPI request failed: ' . $response->status());
        }

        return view('news.index', [
            'articles' => $articles,
            'query' => $searchQuery,
            'error' => $error
        ]);
    }
}