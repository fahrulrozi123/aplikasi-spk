<?php

if (env('MIDTRANS_IS_PRODUCTION') == true) {

    return [
        'midtrans' => [
            // Midtrans server key sandbox
            'serverKey'     => env('MIDTRANS_SERVERKEY'),
            // Midtrans client key sandbox
            'clientKey'     => env('MIDTRANS_CLIENTKEY'),
            'isProduction'  => env('MIDTRANS_IS_PRODUCTION', true),
            'isSanitized'   => env('MIDTRANS_IS_SANITIZED'),
            'is3ds'         => env('MIDTRANS_IS_3DS'),
        ]

    ];

} else {

    return [
        'midtrans' => [
            // Midtrans server key production
            'serverKey'     => env('MIDTRANS_SERVERKEY_SANDBOX'),
            // Midtrans client key production
            'clientKey'     => env('MIDTRANS_CLIENTKEY_SANDBOX'),
            'isProduction'  => env('MIDTRANS_IS_PRODUCTION', false),
            'isSanitized'   => env('MIDTRANS_IS_SANITIZED'),
            'is3ds'         => env('MIDTRANS_IS_3DS'),
        ]

    ];

}


