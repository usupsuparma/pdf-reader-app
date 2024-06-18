<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ProfileController;
use App\Models\EbookModel;
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
    $ebooks = EbookModel::all();
    return view('welcome', compact('ebooks'));
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

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
