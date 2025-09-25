<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpensesController;

Route::get('/', function () {
    return view('index');
})->name('index');
Route::get('/shops/shopList', function () {
    return view('shops.shopList');
})->name('shops.shopList');
Route::get('/shops/form', function () {
    return view('shops.form');
})->name('shops.form');
Route::get('/expenses/expensesList', [ExpensesController::class, 'list'])->name('expenses.expensesList');
Route::get('/expenses/form', [ExpensesController::class, 'create'])->name('expenses.form');
