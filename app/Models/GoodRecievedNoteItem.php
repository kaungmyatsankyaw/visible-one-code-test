<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;


use App\Models\GoodRecievedNote;
use App\Models\DeliveryOrderItem;
use App\Models\InvoiceItem;


class GoodRecievedNoteItem extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $table = 'items';

    protected $guarded = [
        'id'
    ];

    public function note()
    {
        return $this->belongsTo(GoodRecievedNote::class, 'note_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(DeliveryOrderItem::class, 'item_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(InvoiceItem::class, 'item_id', 'id');
    }
}
