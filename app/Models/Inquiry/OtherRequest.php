<?php

namespace App\Models\Inquiry;

use Illuminate\Database\Eloquent\Model;

class OtherRequest extends Model
{
    protected $table = 'inquiry_other_request';

    public $primaryKey = 'id';

    protected $fillable =
    [
        'inquiry_id',
        'other_request_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function master_other_request() {
        return $this->hasOne('App\Models\Inquiry\MasterOtherRequest', 'id', 'other_request_id');
    }
}
