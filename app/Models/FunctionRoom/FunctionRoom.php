<?php

namespace App\Models\FunctionRoom;

use Illuminate\Database\Eloquent\Model;

class FunctionRoom extends Model
{
    protected $table = 'function_room';

    protected $keyType= 'string';

    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'func_name',
        'func_room_slug',
        'func_room_desc',
        'func_dimension',
        'func_class',
        'func_theatre',
        'func_ushape',
        'func_board',
        'func_round',
        'func_head',
        'func_publish_status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function partition()
    {
        return $this->hasMany('App\Models\FunctionRoom\FunctionRoom', 'func_head', 'id')->orderBy('created_at')->orderBy('func_name');
    }

    public function photos()
    {
        return $this->hasMany('App\Models\FunctionRoom\FunctionPhotos', 'function_room_id', 'id');
    }
}
