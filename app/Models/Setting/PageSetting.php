<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class PageSetting extends Model
{
    protected $table = 'page_setting';
    public $primaryKey = 'id';
    protected $fillable = [
        'page_name', 'page_description', 'page_code'
    ];
}
