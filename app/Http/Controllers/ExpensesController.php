<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function list()
    {
       $expenses = Expense::all();
       $sum = $expenses->sum('kwota');
       $shops = \App\Models\Shop::all();
       
        return view('expenses.expensesList', compact('expenses', 'sum', 'shops'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sklep' => 'required|string|max:255',
            'kwota' => 'required|numeric',
            'data_zakupu' => 'required|date',
        ]);

        $expense = new Expense();
        $expense->sklep = $validated['sklep'];
        $expense->kwota = $validated['kwota'];
        $expense->data_zakupu = $validated['data_zakupu'];
       
        
        
        $expense->save();

        return redirect()->route('expenses.expensesList')->with('success', 'Wydatek został dodany pomyślnie.');
    }

    public function create()
    {
        $shops = \App\Models\Shop::all();
        return view('expenses.form', compact('shops'));
       
    }
    public function suma (Request  $request)
    {
        $month = old('month', now()->month);
        $year = old('year', now()->year);
        
      //  $month = $request->input('month',now()->month);
        //$year = $request->input('year',now()->year);
      //  $selectedYear = old('year', now()->year);
      //  $selectedMonth = old('month', now()->month);
       // $selectedShop = old('sklep', '0');    
       $sklep = $request->input('sklep');
        $shops = \App\Models\Shop::all();

        $expense = new Expense();
        
        $expenses = $expense->getExpensesByMonth($month, $year, $sklep);
        $sum = $expense->getTotalExpensesByMonth($month, $year, $sklep);
        return view('expenses.expensesList', compact('expenses', 'sum', 'month', 'year', 'shops', 'sklep'));
            
    }
 
}
