<?php
return [
    'driver'     => env('MAIL_DRIVER', 'smtp'),
    'host'       => env('MAIL_HOST', 'smtp.gmail.com'),
    'port'       => env('MAIL_PORT', 587),
    'from'       => ['address' => 'de.fahimmf@gmail.com', 'name' => 'File Approval System'],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username'   => env('MAIL_USERNAME', 'de.fahimmf@gmail.com'),
    'password'   => env('MAIL_PASSWORD', 'hierkabzsvfbyxgb'),
    'sendmail'   => '/usr/sbin/sendmail -bs'
];


