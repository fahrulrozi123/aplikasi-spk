<?php

namespace App\Models\Room;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

  protected $table = 'room_photo';
  // public $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['room_id', 'photo_path'];


}
