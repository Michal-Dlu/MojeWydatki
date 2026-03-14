<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = ['sklep', 'kwota', 'data_zakupu', 'customer_id'];
    public function customer()
    {        
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function shop()
{
    return $this->belongsTo(Shop::class, 'sklep');
}
    public function getExpensesByMonth($month, $year, $sklep, $customer_id,$perPage=10)
{    
         $query = Expense::query();

    if ($customer_id != '0' && $customer_id != '' && $customer_id != null) {
        $query->where('customer_id', $customer_id);
    }

    $query->when($month, function ($query, $month) {
        return $query->whereMonth('data_zakupu', $month);
    });

    $query->when($year, function ($query, $year) {
        return $query->whereYear('data_zakupu', $year);
    });

    $query->when($sklep, function ($query, $sklep) {
        if ($sklep !== '0') {
            return $query->where('sklep', $sklep);
        }
        return $query;
    });

    $query->orderBy('data_zakupu', 'desc');
       $query->orderBy('data_zakupu', 'desc');

         

    return $query->paginate($perPage)->withQueryString();
}

   
    public function getTotalExpensesByMonth($month, $year, $sklep, $customer_id)
{
    return $this->getExpensesByMonth($month, $year, $sklep, $customer_id)->sum('kwota');
}
}
