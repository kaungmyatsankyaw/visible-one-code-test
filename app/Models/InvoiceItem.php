<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function invoices()
    {
        return $this->belongsTo(GoodRecievedNoteItem::class, 'item_id', 'id');
    }
}
