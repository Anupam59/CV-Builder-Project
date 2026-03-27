<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route::middleware('auth', 'verified')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('users', UserController::class)->except(['show']);

    // ── Customer Routes
    Route::get('customers',                [CustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/search',         [CustomerController::class, 'searchForm'])->name('customers.search');
    Route::post('customers/search/phone',  [CustomerController::class, 'searchByPhone'])->name('customers.search.phone');
    Route::post('customers/attach',        [CustomerController::class, 'attach'])->name('customers.attach');
    Route::post('customers',               [CustomerController::class, 'store'])->name('customers.store');
    Route::get('customers/{customer}',     [CustomerController::class, 'show'])->name('customers.show');

    // ── CV Routes
    // Route::resource('cvs', CvController::class)->except(['index']);


});


require __DIR__ . '/auth.php';
