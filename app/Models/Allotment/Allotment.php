<?php

namespace App\Models\Allotment;

use Illuminate\Database\Eloquent\Model;

class Allotment extends Model
{
    protected $table = 'allotment';

    public $primaryKey = 'id';

    protected $fillable =
    [
        'room_id',
        'user_id',
        'allotment_room',
        'allotment_publish_rate',
        'allotment_ro_rate',
        'allotment_extrabed_rate',
        'allotment_date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
