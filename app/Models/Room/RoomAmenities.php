<?php

namespace App\Models\Room;

use Illuminate\Database\Eloquent\Model;

class RoomAmenities extends Model
{
    protected $table = 'room_amenities';

    //   public $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'room_id',
        'amenities_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function amenities_name() {
        return $this->hasMany('App\Models\Amenities\Amenities', 'id', 'amenities_id');
    }
}
