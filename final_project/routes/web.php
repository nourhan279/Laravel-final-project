<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RegController;

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
    return view('welcome');
});
Route::get('/register', [RegController::class, 'create'])->name('register.create');
Route::get('/set-language/{lang}', function ($lang) {
    session(['locale' => $lang]);
    return redirect()->route('register.create');
});
Route::post('/register', [RegController::class, 'store'])->name('register.store');