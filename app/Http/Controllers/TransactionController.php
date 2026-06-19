<?php

use Midtrans\Config;
use Midtrans\Snap;

Config::$serverKey = config('services.midtrans.server_key');
Config::$isProduction = config('services.midtrans.is_production');

$snapToken = Snap::getSnapToken([
    'transaction_details' => [
        'order_id' => 'INV-' . time(),
        'gross_amount' => $total,
    ],
    'customer_details' => [...],
]);