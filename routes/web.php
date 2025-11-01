<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute untuk Berita (Dapat diakses tanpa login)
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');

// Grup Rute yang Membutuhkan Login (Authenticated)
Route::middleware('auth')->group(function () {
    // Halaman Forum
    Route::get('/forum', [QuestionController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [QuestionController::class, 'create'])->name('forum.create');
    Route::post('/forum', [QuestionController::class, 'store'])->name('forum.store');
    Route::get('/forum/{question}', [QuestionController::class, 'show'])->name('forum.show');
    
    // Jawaban Forum
    Route::post('/forum/{question}/answers', [AnswerController::class, 'store'])->name('questions.answers.store');
    Route::patch('/answers/{answer}/best', [AnswerController::class, 'markAsBest'])->name('answers.mark-best');
    Route::delete('/answers/{answer}', [AnswerController::class, 'destroy'])->name('answers.destroy');

    // Halaman Tanaman
    Route::get('/tanaman', [PlantController::class, 'index'])->name('plants.index');
    Route::post('/tanaman', [PlantController::class, 'store'])->name('plants.store');
    Route::delete('/tanaman/{plant}', [PlantController::class, 'destroy'])->name('plants.destroy');

    // Halaman Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Weather route for plants
    Route::get('/tanaman/weather', [WeatherController::class, 'show'])->name('weather.show');
});

Route::get('/tentang-kami', [PageController::class, 'about'])->name('about.us');

require __DIR__.'/auth.php';