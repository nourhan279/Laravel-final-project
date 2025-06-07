<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
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
Route::get('/English_form', function () {
    return view('English_form', ['lang' => 'en']);
});
Route::get('/Arabic_form', function () {
    return view('Arabic_form', ['lang' => 'ar']);
});
Route::post('/register', [Controller::class, 'store'])->name('register.store');