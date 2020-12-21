<?php

if (env('FASPAY_IS_PRODUCTION') == true) {

    return [
        'endpoint'               => env('FASPAY_IS_PRODUCTION'),
        'merchant'               => env('FASPAY_MERCHANT'),
        'merchantId'             => env('FASPAY_MERCHANT_ID'),
        'merchantPassword'       => env('FASPAY_PASSWORD'),
        'merchantIdCredit'       => env('FASPAY_MERCHANT_ID_CREDIT'),
        'merchantPasswordCredit' => env('FASPAY_PASSWORD_CREDIT')
    ];

} else {

    return [
        'endpoint'               => env('FASPAY_IS_PRODUCTION'),
        'merchant'               => env('FASPAY_MERCHANT'),
        'merchantId'             => env('FASPAY_MERCHANT_ID_DEV'),
        'merchantPassword'       => env('FASPAY_PASSWORD_DEV'),
        'merchantIdCredit'       => env('FASPAY_MERCHANT_ID_CREDIT_DEV'),
        'merchantPasswordCredit' => env('FASPAY_PASSWORD_CREDIT_DEV')
    ];

}


