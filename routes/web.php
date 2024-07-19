<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyCalculatorController;


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
Route::get('/update-currency-rates', [CurrencyCalculatorController::class, 'updateCurrencyRates']); // to be hit by cronjob
Route::get('/currency-calculator', [CurrencyCalculatorController::class, 'index'])->name('currency.calculator');
Route::post('/currency-convert', [CurrencyCalculatorController::class, 'convert'])->name('currency.convert');


Route::get('/', function () {
    return view('welcome');
});
