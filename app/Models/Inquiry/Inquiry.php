<?php

namespace App\Models\Inquiry;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{

    protected $table = 'inquiry';
    public $primaryKey = 'reservation_id';
    public $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['reservation_id', 'customer_id', 'function_room_id','product_id',
        'inq_cust_name', 'inq_cust_phone', 'inq_type', 'inq_total', 'inq_event_name','inq_event_type',
        'inq_participant', 'inq_event_start', 'inq_event_end',
        'inq_alt_start', 'inq_alt_end','inq_arrive_time', 'inq_budget', 'inq_details', 'create_at'];

    public function customer()
    {
        return $this->hasOne('App\Models\Customer\Customer', 'id', 'customer_id');
    }
    public function product()
    {
        return $this->hasOne('App\Models\Product\Product', 'id', 'product_id');
    }
    public function function_room()
    {
        return $this->hasOne('App\Models\FunctionRoom\FunctionRoom', 'id', 'function_room_id');
    }
    public function other_request() {
        return $this->hasMany('App\Models\Inquiry\OtherRequest', 'inquiry_id', 'reservation_id')->with('master_other_request');
    }
}
