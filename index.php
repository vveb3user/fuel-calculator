<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=360, initial-scale=1.0">
    <title>Калькулятор тарифов</title>
    <!-- favicon и meta -->
</head>
<body>
    <div class="page">
        <!-- Хэдер -->
        <?php require __DIR__ . '/php/blocks/header.php'; ?>
        <!-- Основной контейнер калькулятора -->
        <?php require __DIR__ . '/php/blocks/calculator.php'; ?>
        <!-- Модальное окно -->
        <?php require __DIR__ . '/php/blocks/modal.php'; ?>
    </div>
</body>
</html>
