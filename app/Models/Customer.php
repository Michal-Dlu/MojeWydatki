<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Expense;
use App\Models\Shop;

class Customer extends Model
{
    use HasFactory;
    //protected $fillable = ['name']; 
       public function expenses()
    {
        return $this->hasMany('Expense', 'customer_id');
    }
   
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

}
