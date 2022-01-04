<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/printForm', function () {
    return view('printed.patientForm');
})->name("printedForm");

Route::get('/printcard', function () {
    return view('printed.card');
})->name("printcard");

Route::get('/recept', function () {
    return view('printed.recept');
})->name("printrecept");

Route::get('/doctorstatement', function () {
    return view('printed.doctorstatement');
})->name("doctorstatement");

Route::get('/doctorhelper', function () {
    return view('printed.doctorhelper');
})->name("doctorhelper");

Route::get('/m5dr', function () {
    return view('printed.m5dr');
})->name("m5dr");

Route::get('/m5drhelper', function () {
    return view('printed.m5drhelper');
})->name("m5drhelper");



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
