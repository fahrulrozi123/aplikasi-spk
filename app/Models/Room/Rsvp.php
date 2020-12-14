<?php

namespace App\Models\Room;

use Illuminate\Database\Eloquent\Model;
// use NotificationChannels\WebPush\HasPushSubscriptions;

class Rsvp extends Model
{

    // use HasPushSubscriptions;

    protected $table = 'room_rsvp';
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['reservation_id','booking_id','customer_id', 'room_id',
        'rsvp_cust_name', 'rsvp_cust_phone', 'rsvp_cust_idtype', 'rsvp_cust_idnumber', 'rsvp_guest_name',
        'rsvp_special_request', 'rsvp_date_reserve', 'rsvp_adult','rsvp_child','rsvp_breakfast',
        'rsvp_publish_rate', 'rsvp_total_room', 'rsvp_total_amount_room',
        'rsvp_extrabed_rate', 'rsvp_total_extrabed', 'rsvp_total_amount_extrabed',
        'rsvp_tax', 'rsvp_service', 'rsvp_tax_total',
        'rsvp_payment', 'rsvp_convenience_fee', 'rsvp_grand_total', 'rsvp_status', 'cancellation_date', 'reschedule_date', 'endpoint', 'public_key', 'auth_token', 'create_at','expired_at'];

    public function customer()
    {
        return $this->hasOne('App\Models\Customer\Customer', 'id', 'customer_id');
    }

    public function room()
    {
        return $this->hasOne('App\Models\Room\Type', 'id', 'room_id');
    }

    public static function getInclusivePrice($data)
    {
        $room_price = $data->rsvp_total_amount_room;
        $extrabed_price = $data->rsvp_total_amount_extrabed;
        $room_ratio = $room_price / ($room_price + $extrabed_price);
        $extrabed_ratio = 1 - $room_ratio;
        $data->rsvp_total_amount_room = floor($room_price + ($room_ratio  * $data->rsvp_tax) + ($room_ratio  * $data->rsvp_service));
        $data->rsvp_total_amount_extrabed = floor($extrabed_price + ($extrabed_ratio * $data->rsvp_tax) + ($extrabed_ratio  * $data->rsvp_service));
        return $data;
    }

    public function routeNotificationFor($a, $b)
    {
        return $this;
    }
}
