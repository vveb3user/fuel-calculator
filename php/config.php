<?php
return [
    // Цены топлива за тонну
    'fuel_prices' => [
        'petrol' => 500200,
        'gas' => 200100,
        'dt' => 320700
    ],
    
    // Доступные бренды для каждого типа топлива
    'fuel_brands' => [
        'petrol' => ['rosneft', 'tatneft', 'lukoil'],
        'gas' => ['shell', 'gazprom', 'bashneft'],
        'dt' => ['tatneft', 'lukoil']
    ],
    
    // Лимиты прокачки для определения тарифа
    'tariff_limits' => [
        'petrol' => [
            'economy' => 100,
            'selected' => 300
        ],
        'gas' => [
            'economy' => 200,
            'selected' => 700
        ],
        'dt' => [
            'economy' => 150,
            'selected' => 350
        ]
    ],
    
    // Скидки по тарифам
    'tariff_discounts' => [
        'economy' => 3,
        'selected' => 5,
        'premium' => 7
    ],
    
    // Промо-акции по тарифам
    'promo_actions' => [
        'economy' => [2, 5],
        'selected' => [5, 20],
        'premium' => [20, 50]
    ]
];
