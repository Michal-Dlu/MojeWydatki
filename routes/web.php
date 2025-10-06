<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ShopsController;


Route::get('/index', function() {
    return view('index'); })->name('index');  

Route::get('/shops/listaSklepow', [ShopsController::class, 'list'])->name('shops.shopList');
Route::get('/shops/formularz', [ShopsController::class, 'create'])->name('shops.form');
Route::post('/shops/zapisz', [ShopsController::class, 'store'])->name('shops.store');
Route::get('/shops/edytuj/{id}', [ShopsController::class, 'edit'])->name('shops.edit');
Route::put('/shops/aktualizuj/{id}', [ShopsController::class, 'update'])->name('shops.update');
Route::delete('/shops/usun/{id}', [ShopsController::class, 'destroy'])->name('shops.destroy');

Route::get('/expenses/expensesList', [ExpensesController::class, 'list'])->name('expenses.expensesList');
Route::get('/expenses/form', [ExpensesController::class, 'create'])->name('expenses.form');
Route::post('/expenses/zapisz', [ExpensesController::class, 'store'])->name('expenses.store');
Route::post('/expenses/suma', [ExpensesController::class, 'suma'])->name('expenses.suma'); 
