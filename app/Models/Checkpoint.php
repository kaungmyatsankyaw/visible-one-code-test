<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkpoint extends Model
{
    use HasFactory,SoftDeletes;

    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

    protected $guarded = ['id'];

    public function deliveryRoute()
    {
        return $this->belongsToJson(DeliveryRoute::class, 'checkpoint_id', 'id');
    }
}
