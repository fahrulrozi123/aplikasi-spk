<?php

if (env('FASPAY_IS_PRODUCTION') == true) {

    return [
        'emailAddress' => env('MAIL_FROM_ADDRESS'),
        'emailSubject' => env('MAIL_FROM_NAME')
    ];

} else {

    return [
        'emailAddress' => env('MAIL_FROM_ADDRESS_DEV'),
        'emailSubject' => env('MAIL_FROM_NAME_DEV')
    ];

}


