<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

  protected $table = 'customer';
  public $primaryKey = 'id';
  protected $keyType = 'string';
  public $timestamps = false;
  protected $fillable = ['id','cust_email'];

//   public function keluhan() {
//       return $this->belongsTo('App\Models\Finance\Keluhan', 'id_keluhan');
//   }
}
