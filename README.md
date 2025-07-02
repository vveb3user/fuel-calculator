# Fuel Calculator

Калькулятор топлива с AJAX-расчетами и отправкой результатов на email.

## Установка

1. Клонировать репозиторий:
```bash
git clone git@github.com:vveb3user/fuel-calculator.git
cd fuel-calculator
```

2. Установить зависимости:
```bash
npm install
```

3. Собрать CSS:
```bash
npm run build
```

## Разработка

Для разработки с автоматической компиляцией SCSS:
```bash
npm run dev
```

## Развертывание на хосте

1. Загрузить файлы на хостинг
2. Убедиться что PHP включен
3. Настроить отправку email в `php/config.php`
4. Собрать CSS: `npm run build`

## Структура проекта

- `index.html` - главная страница
- `assets/css/` - SCSS стили
- `assets/js/` - JavaScript логика
- `php/` - PHP бэкенд
- `assets/images/` - изображения

## Технологии

- HTML5, CSS3 (SCSS), JavaScript
- PHP для бэкенда
- AJAX для расчетов
- БЭМ методология
