<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    protected $table = 'product_photos';

    public $primaryKey = 'id';

    protected $fillable =
    [
        'product_id',
        'product_photo_path'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
