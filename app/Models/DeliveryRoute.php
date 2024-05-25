<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use App\Models\DeliveryOrder;


class DeliveryRoute extends Model
{
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'checkpoint_id' => 'json'
    ];

    public function checkPoints()
    {
        return $this->hasManyJson(Checkpoint::class, 'id', 'checkpoint_id');
    }

    public function orders()
    {
        return $this->hasMany(DeliveryOrder::class, 'route_id', 'id');
    }
}
