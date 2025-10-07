<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomersController extends Controller
{
    public function list()
    {
       $customers = \App\Models\Customer::all();
       
        return view('customers.customers', compact('customers'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'            
        ]);

        $customer = new Customer();
        $customer->name = $validated['name'];
       
        
        $customer->save();

        return redirect()->route('customers.customers')->with('success', 'Użytkownik został dodany pomyślnie.');
    }

    public function create()
    {
        return view('customers.form');       
    }
    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.customers')->with('success', 'Użytkownik został usunięty pomyślnie.');
    }
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'            
        ]);

        $customer = Customer::findOrFail($id);
        $customer->name = $validated['name'];
        
        $customer->save();

        return redirect()->route('customers.customers')->with('success', 'Użytkownik został zaktualizowany pomyślnie.');
    }
}
