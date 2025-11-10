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

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    
    // User Management
    Route::get('/users', [App\Http\Controllers\Admin\AdminController::class, 'users'])->name('users.index');
    Route::get('/users/{user}/edit', [App\Http\Controllers\Admin\AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\Admin\AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::post('/users/{user}/toggle-admin', [App\Http\Controllers\Admin\AdminController::class, 'toggleAdmin'])->name('users.toggle-admin');
    
    // Forum Management
    Route::get('/forum', [App\Http\Controllers\Admin\AdminController::class, 'forum'])->name('forum.index');
    Route::get('/forum/questions/create', [App\Http\Controllers\Admin\AdminController::class, 'createQuestion'])->name('forum.questions.create');
    Route::post('/forum/questions', [App\Http\Controllers\Admin\AdminController::class, 'storeQuestion'])->name('forum.questions.store');
    Route::get('/forum/questions/{question}/edit', [App\Http\Controllers\Admin\AdminController::class, 'editQuestion'])->name('forum.questions.edit');
    Route::put('/forum/questions/{question}', [App\Http\Controllers\Admin\AdminController::class, 'updateQuestion'])->name('forum.questions.update');
    Route::delete('/forum/questions/{question}', [App\Http\Controllers\Admin\AdminController::class, 'deleteQuestion'])->name('forum.questions.delete');
    Route::delete('/forum/answers/{answer}', [App\Http\Controllers\Admin\AdminController::class, 'deleteAnswer'])->name('forum.answers.delete');
    
    // Plant Monitoring
    Route::get('/plants', [App\Http\Controllers\Admin\AdminPlantController::class, 'index'])->name('plants.index');
    Route::get('/plants/{plant}', [App\Http\Controllers\Admin\AdminPlantController::class, 'show'])->name('plants.show');
    Route::get('/plants/{plant}/edit', [App\Http\Controllers\Admin\AdminPlantController::class, 'edit'])->name('plants.edit');
    Route::put('/plants/{plant}', [App\Http\Controllers\Admin\AdminPlantController::class, 'update'])->name('plants.update');
    Route::delete('/plants/{plant}', [App\Http\Controllers\Admin\AdminPlantController::class, 'destroy'])->name('plants.destroy');
});

Route::get('/tentang-kami', [PageController::class, 'about'])->name('about.us');

require __DIR__.'/auth.php';