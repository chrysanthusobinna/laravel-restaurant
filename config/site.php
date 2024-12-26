<?php
// config/site.php

return [
    'name' => env('APP_NAME', 'Restaurant Site Name'),
    'email' => env('MAIL_FROM_ADDRESS', 'test@example.com'),
    'url' => env('APP_URL', 'http://localhost'),
    'address' => env('ADDRESS', 'Test Address'),
    'country' => 'United States',
    'currency_symbol' => '&#36;',
    'currency_code' => 'USD',
];
