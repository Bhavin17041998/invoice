<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;
use App\Vehicle;

class Bill extends Model
{
    protected $fillable = ['current_date','customer_name','vehicle_name','from_date','to_date','total_amount'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_name');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_name');
    }
}
