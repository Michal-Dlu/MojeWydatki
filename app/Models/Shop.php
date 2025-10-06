<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
    use HasFactory; 
    //public function expenses()
    //{
    //    return $this->hasMany('App\Models\Expense', 'shop_id');
    //}
    public function getNameAttribute()
    {
        return $this->shop_name;
    }
}
