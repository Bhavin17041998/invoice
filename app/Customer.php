<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bill;

class Customer extends Model
{
    protected $fillable = ['name', 'mobile_number', 'address','email'];

}
