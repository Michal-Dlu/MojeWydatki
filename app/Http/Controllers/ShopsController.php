<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function list()
    {
       $shops = Shop::all();
        return view('shops.shopList', ['shops' => $shops]);
    }
    public function create()
    {
        return view('shops.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shop_name' => 'required|string|max:255',
        ]);

        $shop = new Shop();
        $shop->shop_name = $validated['shop_name'];
        $shop->save();

        return redirect()->route('shops.shopList');
    }
    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        return view('shops.edit', ['shop' => $shop]);
    }  
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'shop_name' => 'required|string|max:255',
        ]);

        $shop = Shop::findOrFail($id);
        $shop->shop_name = $validated['shop_name'];
        $shop->save();

        return redirect()->route('shops.shopList');
    }
    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return redirect()->route('shops.shopList');
    } 
}
