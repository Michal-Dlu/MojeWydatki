<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\Customer;    

class ShopsController extends Controller
{
    public function filter(Request $request)
    {       
        $customerId = $request->input('customer_id');
        
        $shops = (new Shop)->getShopsByCustomer($customerId);  
        $customers = Customer::all();
        $customer = Customer::find($customerId);
       
        return view('shops.filter', compact('shops', 'customers', 'customerId', 'customer'));
        }
    
   
    public function create()
    {
            $customers = Customer::all();
            return view('shops.form', compact('customers'));
           
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sklep' => 'required|string|max:255',
            'customer_id' => 'nullable|exists:customers,id'
        ]);

        $shop = new Shop();
        $shop->sklep = $validated['sklep'];
        $shop->customer_id = $validated['customer_id'] ?? null;
        
        $shop->save();

        return redirect()->route('shops.filter')->with('success', 'Sklep został dodany pomyślnie.');
    }
    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        return view('shops.edit', ['shop' => $shop]);
    }  
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'sklep' => 'required|string|max:255',
        ]);

        $shop = Shop::findOrFail($id);
        $shop->sklep = $validated['sklep'];
        $shop->save();
        $customerId = $shop->customer_id;
        
        return redirect()->route('shops.filter',['customerId'=>$customerId])->with('success', 'Sklep został zaktualizowany pomyślnie.');
    }
    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return redirect()->route('shops.filter')->with('success', 'Sklep został usunięty pomyślnie.');
    } 
    public function getShopsByCustomer($customer_id)
    {
        $shops = Shop::where('customer_id', $customer_id)->get();

        if ($shops->isEmpty()) {
            return response()->json(['error' => 'Brak sklepów dla tego użytkownika'], 404);
        }

        return response()->json([
            'shops' => $shops->map(function($shop) {
                return [
                    'id' => $shop->id,
                    'sklep' => $shop->sklep,
                ];
            })
        ]);
    }
}
