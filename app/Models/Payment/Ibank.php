<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;

class Ibank extends Model
{
    protected $table    = 'ibank-notification';
    protected $fillable = 'body';
}
