<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PettyCashRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    '/dashboard',
    [PettyCashRequestController::class, 'index']
)->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/notifications', function () {
    return view('notifications.index');
})->name('notifications.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/petty_cash/create', [PettyCashRequestController::class, 'create'])->name('petty_cash.create');
Route::post('/petty_cash/store', [PettyCashRequestController::class, 'store'])->name('petty_cash.store');
// Route::get('/petty_cash', [PettyCashRequestController::class, 'index'])->name('petty_cash.index');
Route::post('/petty_cash/{pettyCashRequest}/approve', [PettyCashRequestController::class, 'approve'])->name('petty_cash.approve');
Route::post('/petty_cash/{pettyCashRequest}/reject', [PettyCashRequestController::class, 'reject'])->name('petty_cash.reject');
Route::get('/transactions', [PettyCashRequestController::class, 'transactionHistory'])->name('transactions.index');

require __DIR__ . '/auth.php';
