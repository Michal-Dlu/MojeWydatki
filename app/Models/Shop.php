<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
    use HasFactory; 
    
    protected $fillable = ['sklep'];

    // Atrybut pomocniczy do zwrócenia nazwy sklepu
    public function getNameAttribute()
    {
        return $this->sklep;
    }

    // Relacja z modelem Customer (powiązanie)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Zwracanie imienia klienta z relacji
    public function customersName()
    {
        return $this->customers ? $this->customers->name : 'Brak';
    }

    // Statyczna metoda do pobierania sklepów dla danego klienta
    public static function getShopsByCustomer($customer_id)
    {
        return self::where('customer_id', $customer_id)->get();
    }
}
