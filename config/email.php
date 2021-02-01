<?php

if (env('FASPAY_IS_PRODUCTION') == true) {

    return [
        'emailAddress' => env('MAIL_FROM'),
        'emailSubject' => env('MAIL_SUBJECT')
    ];

} else {

    return [
        'emailAddress' => env('MAIL_FROM_DEV'),
        'emailSubject' => env('MAIL_SUBJECT_DEV')
    ];

}


