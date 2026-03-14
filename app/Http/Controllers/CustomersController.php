<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomersController extends Controller
{
    public function list()
    {
       $customers = Customer::all();
       
        return view('customers.customers', compact('customers'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:customers,name'            
        ],
        [
            'name.required' => 'Pole nazwa jest wymagane.',
            'name.string' => 'Pole nazwa musi być tekstem.',
            'name.max' => 'Pole nazwa nie może być dłuższe niż 255 znaków.',
            'name.unique' => 'Nazwa użytkownika ' . $request->input('name') . ' jest już zajęta. Proszę wybrać inną nazwę.'
        ]);

        $customer = new Customer();
        $customer->name = $validated['name'];
       
        
        $customer->save();

        return redirect()->route('customers.customers')->with('success', 'Użytkownik ' . $customer->name . ' został dodany pomyślnie.');
    }

    public function create()
    {
        return view('customers.form');       
    }
    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.customers')->with('success', 'Użytkownik ' . $customer->name . ' został usunięty pomyślnie.');
    }
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:customers,name,' . $id,
        ],
        [
            'name.required' => 'Pole nazwa jest wymagane.',
            'name.string' => 'Pole nazwa musi być tekstem.',
            'name.max' => 'Pole nazwa nie może być dłuższe niż 255 znaków.',
            'name.unique' => 'Nazwa użytkownika jest już zajęta. Proszę wybrać inną nazwę.'
        ]);

        $customer = Customer::findOrFail($id);
        $customer->name = $validated['name'];
        
        $customer->save();

        return redirect()->route('customers.customers')->with('success', 'Użytkownik został zaktualizowany pomyślnie.');
    }
}
