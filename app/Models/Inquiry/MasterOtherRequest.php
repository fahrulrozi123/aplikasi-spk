<?php

namespace App\Models\Inquiry;

use Illuminate\Database\Eloquent\Model;

class MasterOtherRequest extends Model
{
    protected $table = 'master_other_request';

    public $primaryKey = 'id';

    protected $fillable =
    [
        'id',
        'request_name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
