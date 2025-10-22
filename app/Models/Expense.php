<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Expense extends Model
{
    use HasFactory;
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function shop()
{
    return $this->belongsTo(Shop::class, 'sklep');
}
    public function getExpensesByMonth($month, $year, $sklep, $customer_id)
{
    
/*$query = Expense::whereMonth('data_zakupu', $month)
  
        ->whereYear('data_zakupu', $year);
        // Jeśli sklep jest wybrany (sklep != '0'), dodajemy filtr na sklep
        if ($sklep != '0' && $sklep != '' && $sklep != null) {
            $query->where('sklep', $sklep);
        }

        // Jeśli klient jest wybrany (customer_id != '0'), dodajemy filtr na klienta
        if ($customer_id != '0' && $customer_id != '' && $customer_id != null) {
            $query->where('customer_id', $customer_id);
        }
        Log::debug('Przekazane dane: ', ['month' => $month, 'year' => $year, 'sklep' => $sklep, 'customer_id' => $customer_id]);
        Log::debug('Początkowe zapytanie: ' . $query->toSql());
       
       return $query->get();*/
       
      $query = Expense::
              when($month, function ($query, $month) {
            return $query->whereMonth('data_zakupu', $month);
        })
        ->when($year, function ($query, $year) {
            return $query->whereYear('data_zakupu', $year);
        })
        ->when($sklep, function ($query, $sklep) {
            if ($sklep !== '0') {
                return $query->where('sklep', $sklep);
            }
            return $query;
        })
        ->when($customer_id, function ($query, $customer_id) {
            if ($customer_id != '0') {
                return $query->where('customer_id', $customer_id);
            }
        });

    return $query->get();
}

   
    public function getTotalExpensesByMonth($month, $year, $sklep, $customer_id)
{
    return $this->getExpensesByMonth($month, $year, $sklep, $customer_id)->sum('kwota');
}
}
