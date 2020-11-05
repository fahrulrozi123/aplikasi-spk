<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';
    public $primaryKey = 'id';
    protected $fillable = [
        'title', 'logo', 'address',
        'email', 'phone', 'wa_number',
        'so_facebook', 'so_twitter', 'so_instagram'
    ];
}
