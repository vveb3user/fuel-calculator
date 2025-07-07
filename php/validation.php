<?php
function validate_email($email) {
    if (!preg_match('/^\S+@\S+\.\S+$/', $email)) {
        return [
            'invalid_email_format',
            'Введите корректный e-mail'
        ];
    }
    return true;
}

function validate_inn($inn) {
    $inn = preg_replace('/\D/', '', $inn);
    if (strlen($inn) !== 12) {
        return [
            'invalid_inn_length',
            'ИНН должен содержать ровно 12 цифр'
        ];
    }
    return true;
}

function validate_phone($phone) {
    $digits = preg_replace('/\D/', '', $phone);
    if (strpos($digits, '8') === 0) $digits = substr($digits, 1);
    if (strpos($digits, '7') === 0) $digits = substr($digits, 1);
    if (strlen($digits) !== 10) {
        return [
            'invalid_phone_length',
            'Телефон должен содержать ровно 10 цифр после +7'
        ];
    }
    return true;
}

function validate_agree($agree) {
    if (empty($agree)) {
        return [
            'agreement_required',
            'Необходимо согласиться с обработкой персональных данных'
        ];
    }
    return true;
}
