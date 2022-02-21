<?php

namespace App\Models\Amenities;

use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    protected $table = 'amenities';

    public $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable =
    [
        'amenities_name',
        'amenities_icon'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
