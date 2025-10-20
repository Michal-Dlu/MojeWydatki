<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\Shop;

class ExpensesController extends Controller
{
    public function list(Request $request)
    {
           
          $customer_id = $request->input('customer_id');  // Przechwyć dane z formularza
    $expenses = Expense::query()
        ->when($customer_id, function ($query, $customer_id) {
            return $query->where('customer_id', $customer_id);
        })
        ->get();

    $customer = Customer::find($customer_id);  // Znajdź klienta po ID

    $sum = $expenses->sum('kwota');
    $shops = Shop::all();
    $customers = Customer::all();
       
        return view('expenses.expensesList', compact('expenses', 'sum', 'shops','customers', 'customer_id'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'sklep' => 'required|exists:shops|string|max:255',
            'kwota' => 'required|string|max:255',
            'data_zakupu' => 'required|date'
           
        ],['customer_id.exists' => 'Proszę wybrać prawidłowego użytkownika.',
            'sklep.required' => 'Pole sklep jest wymagane.',
           'sklep.exists' => 'Wybrany sklep nie istnieje w bazie danych.',
           'kwota.required' => 'Pole kwota jest wymagane.',
           'data_zakupu.required' => 'Pole data zakupu jest wymagane.',
           'data_zakupu.date' => 'Pole data zakupu musi być prawidłową datą.',
           
        ]);

        $expense = new Expense();
        $expense->sklep = $validated['sklep'];
       
        $expense->kwota = str_replace(',', '.', $validated['kwota']);
        $expense->data_zakupu = $validated['data_zakupu'];
        $expense->customer_id = $validated['customer_id'] ?? null;
        //
       
        $expense->save();

        return redirect()->route('expenses.expensesList')->with('success', 'Wydatek został dodany pomyślnie.');
    }

   
       public function create()
    {
        // Tutaj ładujesz formularz do dodania wydatku (widok expenses.form)
        $customers = Customer::all();
        return view('expenses.form', compact('customers'));
    }      

    public function suma(Request $request)
{
    // Pobierz dane z formularza
    $month = old('month', $request->input('month'));
    $year = old('year', $request->input('year'));
    $sklep = old('sklep', $request->input('sklep', '0'));
    $customer_id = old('customer_id', $request->input('customer_id', '0'));

    // Jeśli nie wybrano klienta, ustaw wartość '0'
    if ($customer_id == "Wybierz użytkownika") {
        $customer_id = '0';
    }
if ($sklep == "Wybierz sklep") {
        $sklep = '0';
    }
    // Pobierz sklep i dane klienta na podstawie przekazanych parametrów
    if ($customer_id != '0') {
        $customer = Customer::find($customer_id); // Zapisz dane klienta
        $shops = Shop::where('customer_id', $customer_id)->get(); // Pobierz sklepy przypisane do klienta
    } else {
        $customer = null; // Jeśli nie ma wybranego klienta, ustaw null
        $shops = Shop::all(); // Jeśli klient nie wybrany, weź wszystkie sklepy
    }

    // Pobierz wydatki na podstawie parametrów
    $expenses = (new Expense())->getExpensesByMonth($month, $year, $sklep, $customer_id);
    $sum = (new Expense())->getTotalExpensesByMonth($month, $year, $sklep, $customer_id);

   
$customers = Customer::all();
    // Zwróć widok z danymi
    return view('expenses.expensesList', compact('expenses', 'sum', 'month', 'year', 'shops', 'customer', 'customer_id', 'customers'));
}
public function edit($id)
{
    $expense = Expense::findOrFail($id);
    $customers = Customer::all();
    $customerName = $expense->customer->name;
    
    
     $sklepName = $expense->sklep;
    return view('expenses.edit', compact('expense','customers','customerName','sklepName'));

}
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'customer_id' => 'nullable|exists:customers,id',
        'sklep' => 'required|exists:shops|string|max:255',
        'kwota' => 'required|string|max:255',
        'data_zakupu' => 'required|date'
    ],[
        'customer_id.exists' => 'Proszę wybrać prawidłowego użytkownika.',
        'sklep.required' => 'Pole sklep jest wymagane.',
        'sklep.exists' => 'Wybrany sklep nie istnieje w bazie danych.',
        'kwota.required' => 'Pole kwota jest wymagane.',
        'data_zakupu.required' => 'Pole data zakupu jest wymagane.',
        'data_zakupu.date' => 'Pole data zakupu musi być prawidłową datą.',
    ]);

    $expense = Expense::findOrFail($id);
    $expense->sklep = $validated['sklep'];
    $expense->kwota = str_replace(',', '.', $validated['kwota']);
    $expense->data_zakupu = $validated['data_zakupu'];
    $expense->customer_id = $validated['customer_id'] ?? null;
    $expense->save();

    return redirect()->route('expenses.expensesList')->with('success', 'Wydatek został zaktualizowany pomyślnie.');
}
public function destroy($id)
{
    $expense = Expense::findOrFail($id);
    $expense->delete();

    return redirect()->route('expenses.expensesList')->with('success', 'Wydatek został usunięty pomyślnie.');
}
}
