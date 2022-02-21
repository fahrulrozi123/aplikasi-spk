<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table    = 'payment';

    public $primaryKey  = 'transaction_id';

    protected $keyType  = 'string';

    public $timestamps  = false;

    protected $fillable =
    [
        'transaction_id',
        'booking_id',
        'merchant_id',
        'from_table',
        'gross_amount',
        'currency',
        'transaction_status',
        'transaction_time',
        'payment_reff',
        'settlement_time',
        'fraud_status',
        'payment_type',
        'status_code',
        'status_message',
        'signature_key',
        'redirect_url'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
