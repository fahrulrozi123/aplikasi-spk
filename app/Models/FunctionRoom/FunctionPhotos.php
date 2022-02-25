<?php

namespace App\Models\FunctionRoom;

use Illuminate\Database\Eloquent\Model;

class FunctionPhotos extends Model
{
    protected $table = 'function_room_photos';

    public $primaryKey = 'id';

    protected $fillable =
    [
        'function_room_id',
        'photo_path'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
