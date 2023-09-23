<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});



Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('dashboard');
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('products',\App\Http\Controllers\ProductController::class);

    Route::get('/orders', [\App\Http\Controllers\OrderController::class,'index'])->name('orders.index');
    Route::post('/orders/confirm/{order}', [\App\Http\Controllers\OrderController::class,'confirm'])->name('orders.confirm');
    Route::post('/orders/reject/{order}', [\App\Http\Controllers\OrderController::class,'reject'])->name('orders.reject');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
