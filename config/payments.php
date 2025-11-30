<?php

return [
    'provider' => env('PAYMENT_PROVIDER', 'stripe'),

    'stripe' => [
        'secret' => env('STRIPE_SECRET'),
        'public' => env('STRIPE_PUBLIC'),
    ],

    'paystack' => [
        'secret' => env('PAYSTACK_SECRET'),
        'public' => env('PAYSTACK_PUBLIC'),
    ],
];
