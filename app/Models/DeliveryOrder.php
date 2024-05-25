<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use App\Models\GoodRecievedNoteItem;

use App\Models\User;
use App\Models\Customer;
use App\Models\Car;
use App\Models\DeliveryRoute;
use App\Models\DeliveryOrderItem;

class DeliveryOrder extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [
        'id'
    ];

    public function items()
    {
        return $this->hasMany(DeliveryOrderItem::class, 'delivery_order_id', 'id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function route()
    {
        return $this->belongsTo(DeliveryRoute::class, 'route_id', 'id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
}
