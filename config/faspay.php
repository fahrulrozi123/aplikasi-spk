<?php

if (env('FASPAY_IS_PRODUCTION') == true) {

    return [
        'endpoint'         => env('FASPAY_IS_PRODUCTION'),
        'merchant'         => env('FASPAY_MERCHANT'),
        'merchantId'       => env('FASPAY_MERCHANT_ID'),
        'merchantPassword' => env('FASPAY_PASSWORD'),
    ];

} else {

    return [
        'endpoint'         => env('FASPAY_IS_PRODUCTION'),
        'merchant'         => env('FASPAY_MERCHANT'),
        'merchantId'       => env('FASPAY_MERCHANT_ID_DEV'),
        'merchantPassword' => env('FASPAY_PASSWORD_DEV'),
    ];

}


