<?php

// config for Kogol1/RaiffeisenbankPremiumApiLaravel
return [
    'use_sandbox' => env('RAIFFEISENBANK_PREMIUM_API_USE_SANDBOX', true),

    'base_uri' => env('RAIFFEISENBANK_PREMIUM_API_URL', 'https://api.rb.cz/'),
    'client_id' => env('RAIFFEISENBANK_PREMIUM_API_CLIENT_ID', ''),

    'cert_file_path' => env('RAIFFEISENBANK_PREMIUM_API_CERT_FILE_PATH', ''),
    'cert_password' => env('RAIFFEISENBANK_PREMIUM_API_CERT_PASSWORD', ''),

    'ssl_key_file_path' => env('RAIFFEISENBANK_PREMIUM_API_SSL_KEY_FILE_PATH', ''),
];
