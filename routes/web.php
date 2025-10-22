<?php

use App\Http\Controllers\CustomersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ShopsController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/index', function() {
    return view('index'); })->name('index');  


Route::get('/shops/formularz', [ShopsController::class, 'create'])->name('shops.form');
Route::post('/shops/zapisz', [ShopsController::class, 'store'])->name('shops.store');
Route::get('/shops/edytuj/{id}', [ShopsController::class, 'edit'])->name('shops.edit');
Route::put('/shops/aktualizuj/{id}', [ShopsController::class, 'update'])->name('shops.update');
Route::delete('/shops/usun/{id}', [ShopsController::class, 'destroy'])->name('shops.destroy');
Route::get('/shops/filter', [ShopsController::class, 'filter'])->name('shops.filter');
Route::get('/get-shops-by-customer/{customerId}', [ShopsController::class, 'getShopsByCustomer']);
      

Route::get('/expenses/expensesList', [ExpensesController::class, 'list'])->name('expenses.expensesList');
Route::get('/expenses/form', [ExpensesController::class, 'create'])->name('expenses.form');
Route::post('/expenses/zapisz', [ExpensesController::class, 'store'])->name('expenses.store');
Route::post('/expenses/suma', [ExpensesController::class, 'suma'])->name('expenses.suma'); 
Route::get('/expenses/edytuj/{id}', [ExpensesController::class, 'edit'])->name('expenses.edit');
Route::put('/expenses/aktualizuj/{id}', [ExpensesController::class, 'update'])->name('expenses.update');
Route::delete('/expenses/usun/{id}', [ExpensesController::class, 'destroy'])->name('expenses.destroy');

Route::get('/customers/customers', [CustomersController::class, 'list'])->name('customers.customers');
Route::get('/customers/form', [CustomersController::class, 'create'])->name('customers.form');
Route::post('/customers/zapisz', [CustomersController::class, 'store'])->name('customers.store');
Route::get('/customers/edytuj/{id}', [CustomersController::class, 'edit'])->name('customers.edit');
Route::put('/customers/aktualizuj/{id}', [CustomersController::class, 'update'])->name('customers.update');
Route::delete('/customers/usun/{id}', [CustomersController::class, 'delete'])->name('customers.delete');
