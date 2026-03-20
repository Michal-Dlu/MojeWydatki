<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Carbon;

use function Symfony\Component\String\s;

class ExpensesController extends Controller
{
    public function list(Request $request)
    {           
        $customer_id = $request->input('customer_id'); 
        session(['last_selected_customer' => $customer_id]); // Przechwyć dane z formularza
        $expensesQuery = Expense::query()
        ->when($customer_id, fn($query)=>$query->where('customer_id',$customer_id))
        ->where('data_zakupu', '>=', Carbon::now()->subMonth()) 
        ->orderBy('data_zakupu', 'desc');
    
                
        $sum = $expensesQuery->sum('kwota');
        $perPage = $request->input('perPage', 10);
        $expenses = $expensesQuery->paginate($perPage)->withQueryString();  // Dodaj paginację, np. 10 rekordów na stronę

        $customer = Customer::find($customer_id);  // Znajdź klienta po ID
    

        $shops = Shop::orderBy('sklep', 'asc')->get();
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
        
       
        $expense->save();
        session(['last_selected_customer' => $expense->customer_id]);

        return redirect()->route('expenses.expensesList')->with('success', 'Wydatek został dodany pomyślnie.');
    }

   
       public function create()
    {
        // Tutaj ładujesz formularz do dodania wydatku (widok expenses.form)
        $customers = Customer::all();
        $lastShop = Shop::latest()->first();
        $lastCustomer = Customer::latest()->first();// Pobierz ostatnio dodany klient
           // Zapisz ostatnio wybranego klienta do sesji, tylko jeśli klient został wybrany
        

        return view('expenses.form', compact('customers', 'lastShop', 'lastCustomer')); // Przekaż
    }      

    public function suma(Request $request)
{
   
    // Pobierz dane z formularza
    $month = old('month', $request->input('month'));
    $year = old('year', $request->input('year'));
    $sklep = old('sklep', $request->input('sklep', '0'));
    if($request->filled('customer_id')) {
        $customer_id = $request->input('customer_id');
    } else {
        $customer_id = session('last_selected_customer', '0'); // Pobierz ostatnio wybranego klienta z sesji, domyślnie '0'
    }
   // Pobierz ostatnio wybranego klienta z sesji, domyślnie '0'
    $customer_id = old('customer_id', $request->input('customer_id', session('last_selected_customer', '0')));

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
   $perPage = $request->input('perPage', 10);

// Query z filtrami
$query = Expense::query();

if ($customer_id != '0') {
    $query->where('customer_id', $customer_id);
}

if ($month) {
    $query->whereMonth('data_zakupu', $month);
}

if ($year) {
    $query->whereYear('data_zakupu', $year);
}

if ($sklep && $sklep != '0') {
    $query->where('sklep', $sklep);
}

// Suma wszystkich dopasowanych rekordów
$sum = (clone $query)->sum('kwota');

// Paginacja po wszystkich rekordach
$expenses = $query->orderBy('data_zakupu', 'desc')
                  ->paginate($perPage)
                  ->withQueryString();


$customers = Customer::all();
 

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
