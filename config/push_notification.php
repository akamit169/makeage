<?php

return [  
    'apple' => [

        'sandbox' => [
            'url' => 'ssl://gateway.sandbox.push.apple.com:2195',
            'pem_file' => public_path('apple_pems') . '/iOSPushdev.pem',
            'passphrase' => ''
        ],
        'production' => [
            'url' => 'ssl://gateway.push.apple.com:2195',
            'pem_file' => public_path('apple_pems') . '/iOSPushDistribution.pem',
            'passphrase' => ''
        ]
    ],

];  