<?php

namespace App\Models\Room;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'room_photo';

    public $primaryKey = 'id';

    protected $fillable = [
        'room_id',
        'photo_path'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
