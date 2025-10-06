<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
       public function expenses()
    {
        return $this->hasMany('App\Models\Expense', 'customer_id');
    }
}
