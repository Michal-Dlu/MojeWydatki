<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function list()
    {
       $expenses = Expenses::all();
        return view('expenses.expensesList', ['expenses' => $expenses]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sklep' => 'required|string|max:255',
            'kwota' => 'required|numeric',
            'data_zakupu' => 'required|date',
        ]);

        $expense = new Expenses();
        $expense->sklep = $validated['sklep'];
        $expense->kwota = $validated['kwota'];
        $expense->data_zakupu = $validated['data_zakupu'];
        $expense->save();

        return redirect()->route('expenses.expensesList');
    }

    public function create()
    {
        return view('expenses.form');
    }
}
