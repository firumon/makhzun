<?php

    return [
        'product' => [
            'driver' => 'local',
            'root' => public_path('makhzun/uploads/products'),
            'url' => env('APP_URL').'/products',
            'visibility' => 'public',
        ],
        'partner' => [
            'driver' => 'local',
            'root' => public_path('makhzun/uploads/partners'),
            'url' => env('APP_URL').'/partners',
            'visibility' => 'public',
        ],
        'document' => [
            'driver' => 'local',
            'root' => public_path('makhzun/uploads/documents'),
            'url' => env('APP_URL').'/documents',
            'visibility' => 'public',
        ],
    ];
