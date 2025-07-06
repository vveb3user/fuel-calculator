<?php
header('Content-Type: application/json');

require_once __DIR__ . '/config.php';

$config = require __DIR__ . '/config.php';

// Получаем данные из POST запроса
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Неверные данные']);
    exit;
}

// Извлекаем параметры
$regionId = $data['region'] ?? null;
$volume = (int)($data['volume'] ?? 0);
$fuelType = $data['fuelType'] ?? 'petrol';
$brand = $data['brand'] ?? '';
$services = $data['services'] ?? [];
$promoPercent = (int)($data['promoPercent'] ?? 0);

// Валидация входных данных
if (!$regionId || $volume <= 0 || !in_array($fuelType, ['petrol', 'gas', 'dt'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Неверные параметры']);
    exit;
}

// Получаем лимиты региона
$regions = require __DIR__ . '/regions.php';
$regionLimit = 500;
foreach ($regions as $region) {
    if ($region['id'] === $regionId) {
        $regionLimit = $region['limit'];
        break;
    }
}

// Проверяем лимит прокачки
if ($volume > $regionLimit) {
    http_response_code(400);
    echo json_encode(['error' => "Превышен лимит прокачки для региона: {$regionLimit} тонн"]);
    exit;
}

// Определяем тариф на основе объема прокачки
$tariffLimits = $config['tariff_limits'][$fuelType];
$tariff = 'economy';
if ($volume > $tariffLimits['selected']) {
    $tariff = 'premium';
} elseif ($volume > $tariffLimits['economy']) {
    $tariff = 'selected';
}

// Рассчитываем стоимость топлива
$fuelPrice = $config['fuel_prices'][$fuelType];
$monthlyCost = $fuelPrice * $volume;

// Применяем скидки
$tariffDiscount = $config['tariff_discounts'][$tariff];
$promoDiscount = $promoPercent;

$totalDiscount = $tariffDiscount + $promoDiscount;
$discountAmount = ($monthlyCost * $totalDiscount) / 100;
$finalCost = $monthlyCost - $discountAmount;

// Рассчитываем экономию
$monthlySavings = $discountAmount;
$yearlySavings = $monthlySavings * 12;

// Получаем доступные промо-акции для текущего тарифа
$availablePromos = $config['promo_actions'][$tariff];

// Формируем ответ
$response = [
    'success' => true,
    'data' => [
        'tariff' => $tariff,
        'monthlyCost' => round($monthlyCost),
        'finalCost' => round($finalCost),
        'totalDiscount' => $totalDiscount,
        'monthlySavings' => round($monthlySavings),
        'yearlySavings' => round($yearlySavings),
        'availablePromos' => $availablePromos,
        'regionLimit' => $regionLimit
    ]
];

echo json_encode($response, JSON_UNESCAPED_UNICODE);
