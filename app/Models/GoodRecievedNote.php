<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\GoodRecievedNoteItem;
use App\Models\Customer;
use App\Models\Branch;

class GoodRecievedNote extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];

    public function items()
    {
        return $this->hasMany(GoodRecievedNoteItem::class, 'note_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id', 'id');
    }



}
