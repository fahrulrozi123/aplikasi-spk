<?php

namespace App\Models\Room;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $table = 'room_bed';

    public $primaryKey = 'id';

    protected $fillable = [
        'room_id',
        'bed_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
