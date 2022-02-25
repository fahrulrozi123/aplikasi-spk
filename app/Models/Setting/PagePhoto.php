<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class PagePhoto extends Model
{
    protected $table = 'page_photo';

    public $primaryKey = 'id';

    protected $fillable = [
        'page_id',
        'photo_path'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
