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
    return redirect('login');
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


Route::get('/hmsstatement', function () {
    return view('printed.hospitalstatement');
})->name("hmsstatement");

Route::get('/income', function () {
    return view('printed.income');
})->name("income");

Route::get('/expense', function () {
    return view('printed.expense');
})->name("expense");

Route::get('/qablat', function () {
    return view('printed.qablat');
})->name("qablat");

Route::get('/doctorpays', function () {
    return view('printed.doctorpays');
})->name("doctorpays");


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
