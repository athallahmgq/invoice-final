<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Auth; 

Route::get('/', function () {
    return view('welcome'); // Atau redirect ke login jika belum login
});

// Authentication Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->name('login.submit')->middleware('guest');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register.form')->middleware('guest');
Route::post('register', [AuthController::class, 'register'])->name('register.submit')->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// Invoice Routes (Protected by auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    // Tambahkan route untuk edit, update, delete jika ada
    Route::get('/invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::put('/invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
    Route::get('/invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');
});

// Redirect ke login jika user mengakses / dan belum login
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('invoices.index');
    }
    return redirect()->route('login.form');
})->name('home');