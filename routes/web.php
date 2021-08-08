<?php

use App\Http\Controllers\MessageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/chat', function (){
    return Inertia::render('Messenger/Index');
});

Route::middleware(['web','auth'])->group(function (){
    Route::prefix('conversations')->name('conversations.')->group(function (){
        Route::get('/',      [MessageController::class, 'getDialogs' ])     ->name('get');
        Route::get('/{id}',  [MessageController::class, 'getMessages'])     ->name('get.messages');
        Route::post('/send', [MessageController::class, 'sendMessage'])     ->name('send.message');
    });
});
