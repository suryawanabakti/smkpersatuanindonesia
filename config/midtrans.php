<?php

return [
    'merchant_id' => env('MIDTRANS_MERCHANT_ID', 'G066882704'),
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-sZi_IL9FMDmupLpS'),
    'server_key' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-T9rgXVcQhXrfk5mz379pnRTg'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
];
