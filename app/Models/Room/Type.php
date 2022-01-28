<?php

namespace App\Models\Room;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class Type extends Model
{
    protected $dateNow;

    protected $table = 'room_type';

    protected $keyType = 'string';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'room_name',
        'room_desc',
        'room_slug',
        'room_allotment',
        'room_publish_rate',
        'room_ro_rate',
        'room_weekend_rate',
        'room_weekend_ro_rate',
        'room_extrabed_rate',
        'room_future_availability',
        'room_order'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function bed()
    {
        return $this->hasMany('App\Models\Room\Bed', 'room_id', 'id')->orderBy('bed_id');
    }

    public function photo()
    {
        return $this->hasMany('App\Models\Room\Photo', 'room_id', 'id');
    }

    public function allotment()
    {
        return $this->hasMany('App\Models\Allotment\Allotment', 'room_id', 'id');
    }

    public function allotment_day()
    {
        $this->dateNow = Carbon::now()->format('Y-m-d');
        return $this->hasMany('App\Models\Allotment\Allotment', 'room_id', 'id')->where('allotment_date', $this->dateNow);
    }

    public function amenities()
    {
        return $this->hasMany('App\Models\Room\RoomAmenities', 'room_id', 'id')->orderBy('amenities_id')->with('amenities_name');
    }

    public function rsvp()
    {
        return $this->hasMany('App\Models\Room\Rsvp', 'room_id', 'id')->where('rsvp_status', 'Payment received');
    }

    public function remaining_allotment()
    {
        $query = "SELECT allotment.id, allotment.allotment_room, allotment.allotment_date,
            (allotment.allotment_room - (SELECT Ifnull(SUM(rsvp_total_room), 0) FROM room_rsvp
            WHERE room_id = room_type.id AND rsvp_date_reserve = allotment.allotment_date
            AND rsvp_status IN ('Payment received', 'Waiting for payment') )) AS allotment_remaining
            FROM allotment where room_id = room_type.id";
        $allotment = DB::select(DB::raw($query));
        return $allotment;
    }
}
