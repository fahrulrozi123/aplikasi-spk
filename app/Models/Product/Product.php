<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

  protected $table = 'product';
  protected $keyType = 'string';
  public $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['id', 'product_name', 'product_detail','product_price','sales_inquiry','category'];

  public function photos() {
    return $this->hasMany('App\Models\Product\Photos', 'product_id', 'id');
  }
  
  public function rsvp() {
    return $this->hasMany('App\Models\Product\Rsvp', 'product_id', 'id')->where('rsvp_status','Payment received');
  }
}