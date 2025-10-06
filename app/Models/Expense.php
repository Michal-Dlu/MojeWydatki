<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function getExpensesByMonth($month, $year, $sklep)
    {
        return $this->whereYear('data_zakupu', $year)
                    ->whereMonth('data_zakupu', $month)
                    ->when($sklep, function ($query, $sklep) {
                        if ($sklep != '0') {
                            return $query->where('sklep', $sklep);
                        }
                        return $query;
                    })
                    ->get();
    }
   
    public function getTotalExpensesByMonth($month, $year, $sklep)
    {
        return $this->whereYear('data_zakupu', $year)
                    ->whereMonth('data_zakupu', $month)
                    ->when($sklep, function ($query, $sklep) {
                        if ($sklep != '0') {
                            return $query->where('sklep', $sklep);
                        }
                        return $query;
                    })
                    ->sum('kwota');
    }
}
