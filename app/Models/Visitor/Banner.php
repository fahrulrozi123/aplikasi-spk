<?php

namespace App\Models\Visitor;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{

  protected $table = 'visitor_banner';
  public $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['banner_name', 'banner_status','uploaded_at'];

//   public function keluhan() {
//       return $this->belongsTo('App\Models\Finance\Keluhan', 'id_keluhan');
//   }
}
