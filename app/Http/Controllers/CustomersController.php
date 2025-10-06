<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        $customer = new \App\Models\Customer();
        $customer->name = $validated['name'];
       
        
        $customer->save();

        return redirect()->route('customers.customers')->with('success', 'Użytkownik został dodany pomyślnie.');
    }

    public function create()
    {
        return view('customers.form');
       
    }
}
