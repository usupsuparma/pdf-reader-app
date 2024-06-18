<?php

use App\Http\Controllers\EbookController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $users = [
        ['id' => 1, 'name' => 'Lindsay Walton', 'title' => 'Front-end Developer', 'email' => 'lindsay.walton@example.com', 'role' => 'Member'],
        ['id' => 2, 'name' => 'Courtney Henry', 'title' => 'Designer', 'email' => 'courtney.henry@example.com', 'role' => 'Admin'],
        ['id' => 3, 'name' => 'Tom Cook', 'title' => 'Director of Product', 'email' => 'tom.cook@example.com', 'role' => 'Member'],
        ['id' => 4, 'name' => 'Whitney Francis', 'title' => 'Copywriter', 'email' => 'whitney.francis@example.com', 'role' => 'Admin'],
        ['id' => 5, 'name' => 'Leonard Krasner', 'title' => 'Senior Designer', 'email' => 'leonard.krasner@example.com', 'role' => 'Owner'],
        ['id' => 6, 'name' => 'Floyd Miles', 'title' => 'Principal Designer', 'email' => 'floyd.miles@example.com', 'role' => 'Member'],
    ];
    return view('welcome', compact('users'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('ebooks')->group(function () {
        Route::get('add', [EbookController::class, 'add'])->name('ebooks.add');
        Route::post('store', [EbookController::class, 'store'])->name('ebooks.store');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/carbonera', [FolderController::class, 'openCarbonera'])->name('open.carbonera');

require __DIR__ . '/auth.php';
