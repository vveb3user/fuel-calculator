<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require_once __DIR__ . '/validation.php';
$config = require __DIR__ . '/config.php';

// Получаем данные из POST
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'invalid_json', 'message' => 'Некорректные данные']);
    exit;
}

// Валидация полей формы
$email = trim($data['email'] ?? '');
$res = validate_email($email);
if ($res !== true) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $res[0], 'message' => $res[1]]);
    exit;
}

$inn = $data['inn'] ?? '';
$res = validate_inn($inn);
if ($res !== true) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $res[0], 'message' => $res[1]]);
    exit;
}
$phone = $data['phone'] ?? '';
$res = validate_phone($phone);
if ($res !== true) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $res[0], 'message' => $res[1]]);
    exit;
}
$res = validate_agree($data['agree'] ?? null);
if ($res !== true) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $res[0], 'message' => $res[1]]);
    exit;
}

$results = $data['results'] ?? [];

$regionName = '-';
if (isset($results['region'])) {
    foreach ($config['regions'] as $reg) {
        if ($reg['id'] == $results['region']) {
            $regionName = $reg['name'];
            break;
        }
    }
}

function format_rub($num) {
    if (!is_numeric($num)) return $num;
    return number_format($num, 0, ',', ' ') . ' ₽';
}

// Текст письма
$body = "Заявка на тариф\n\n";
$body .= "Регион: " . $regionName . "\n";
$body .= "Прокачка: " . ($results['volume'] ?? '-') . " тонн\n";
$body .= "Тип топлива: " . ($results['fuelTypeName'] ?? ($results['fuelType'] ?? '-')) . "\n";
$body .= "Бренд: " . ($results['brand'] ?? '-') . "\n";
$body .= "Дополнительные услуги: ";
if (isset($results['services'])) {
    if (is_array($results['services'])) {
        $body .= implode(', ', $results['services']);
    } else {
        $body .= $results['services'];
    }
} else {
    $body .= '-';
}
$body .= "\n";
$body .= "Тариф: " . ($results['tariffName'] ?? ($results['tariff'] ?? '-')) . "\n";
$body .= "Промо-акция: " . ($results['promoDesc'] ?? '-') . "\n";
$body .= "Стоимость топлива в месяц: " . (isset($results['monthlyCost']) ? format_rub($results['monthlyCost']) : '-') . "\n";
$body .= "Суммарная скидка %: " . ($results['totalDiscount'] ?? '-') . "\n";
$body .= "Экономия в месяц: " . (isset($results['monthlySavings']) ? format_rub($results['monthlySavings']) : '-') . "\n";
$body .= "Экономия в год: " . (isset($results['yearlySavings']) ? format_rub($results['yearlySavings']) : '-') . "\n\n";
$body .= "Данные формы:\n";
$body .= "ИНН: $inn\n";
$body .= "Телефон: +7" . preg_replace('/\D/', '', $phone) . "\n";
$body .= "E-mail: $email\n";

$to = $email;
$subject = "Заявка на тариф";
$headers = "From: noreply@yourdomain.com\r\nContent-Type: text/plain; charset=UTF-8";

$sent = mail($to, $subject, $body, $headers);

if ($sent) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'mail_failed', 'message' => 'Не удалось отправить письмо']);
} 