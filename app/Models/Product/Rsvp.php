<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{

    protected $table = 'product_rsvp';
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['reservation_id','booking_id','customer_id', 'product_id',
                            'rsvp_date_reserve','rsvp_arrive_time', 'rsvp_cust_name', 'rsvp_cust_phone', 'rsvp_cust_idtype',
                            'rsvp_cust_idnumber','rsvp_guest_name', 'rsvp_special_request', 'rsvp_amount_pax', 'rsvp_pax_price',
                            'rsvp_total_amount', 'rsvp_tax', 'rsvp_service', 'rsvp_tax_total',
                            'rsvp_payment', 'rsvp_convenience_fee',
                            'rsvp_grand_total', 'rsvp_status', 'cancellation_date','reschedule_date','create_at','expired_at'];

    public function customer()
    {
        return $this->hasOne('App\Models\Customer\Customer', 'id', 'customer_id');
    }

    public function product()
    {
        return $this->hasOne('App\Models\Product\Product', 'id', 'product_id')->with('photos');
    }
    public function payment()
    {
        return $this->hasOne('App\Models\Payment\Payment', 'rsvp_id', 'reservation_id');
    }
    public static function getInclusivePrice($data)
    {
        $data->rsvp_total_amount += $data->rsvp_tax + $data->rsvp_service;
        return $data;
    }
}
