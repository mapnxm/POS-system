<?php
return [
    'merchant_id'  => env('MIDTRANS_MERCHANT_ID', ),
    'serverKey'   => env('MIDTRANS_SERVER_KEY',),
    'client_key'   => env('MIDTRANS_CLIENT_KEY',),
    'is_production' => Env('MIDTRANS_IS_PRODUCTION'),
    'is_sanitized'  => true,
    'is_3ds'        => true,
];
