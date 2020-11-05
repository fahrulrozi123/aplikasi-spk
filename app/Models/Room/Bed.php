<?php

namespace App\Models\Room;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{

  protected $table = 'room_bed';
//   public $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['room_id', 'bed_id'];  
}
