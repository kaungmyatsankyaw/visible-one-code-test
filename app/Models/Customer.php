<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use App\Models\GoodRecievedNote;
use App\Models\DeliveryOrder;
use App\Models\Invoice;



class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];

    public function goodRecievedNote()
    {
        return $this->hasMany(GoodRecievedNote::class, 'customer_id', 'id');

    }

    public function orders()
    {
        return $this->hasMany(DeliveryOrder::class, 'customer_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'customer_id', 'id');
    }

}
