<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    public $primaryKey = 'id';

    protected $keyType = 'string';

    protected $fillable =
    [
        'id',
        'cust_email'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
