<?php

namespace App\Models\Inquiry;

use Illuminate\Database\Eloquent\Model;

class OtherRequest extends Model
{

    protected $table = 'inquiry_other_request';
  //   public $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['inquiry_id', 'other_request_id']; 

    public function master_other_request() {
        return $this->hasOne('App\Models\Inquiry\MasterOtherRequest', 'id', 'other_request_id');
    }
  }
