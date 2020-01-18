<?php

return [
    'useFileTransport' => env('YII_DEBUG'),
//    'useFileTransport' => false,
    'class' => 'yii\swiftmailer\Mailer',
    'viewPath' => '@app/mail',
    'htmlLayout' => '@app/mail/layouts/html',
    'textLayout' => '@app/mail/layouts/text',  // custome layout
    // send all mails to a file by default. You have to set
    // 'useFileTransport' to false and configure a transport
    // for the mailer to send real emails.
    'transport' => \yii\helpers\ArrayHelper::merge([
        'class' => 'Swift_SmtpTransport',
        'host' => env('NO_REPLY_EMAIL_SMTP'),  // e.g. smtp.mandrillapp.com or smtp.gmail.com
        'username' => env('NO_REPLY_EMAIL_USER'),
        'password' => env('NO_REPLY_EMAIL_PASSWORD'),
        'port' => env('NO_REPLY_EMAIL_SMTP_PORT'),
    ], (env('NO_REPLY_EMAIL_SMTP_SECURE') ? ['encryption' => env('NO_REPLY_EMAIL_SMTP_SECURE')] : []))
];
