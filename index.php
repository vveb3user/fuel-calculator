<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Калькулятор тарифов</title>
        <!-- favicon и meta -->
        <link rel="icon" type="image/png" href="assets/images/favicon.png">
        <link href="https://fonts.googleapis.com/css?family=Inter:400,500,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/main.css">
    </head>
    <body>
        <!-- Хэдер -->
        <?php require __DIR__ . '/php/blocks/header.php'; ?>
        <!-- Калькулятор и карточка -->
        <div class="calculator-summary-container">
            <!-- Калькулятор -->
            <?php require __DIR__ . '/php/blocks/calculator.php'; ?>
            <!-- Тариф, промо, экономия -->
            <?php require __DIR__ . '/php/blocks/summary.php'; ?>
        </div>
        <!-- Модальное окно -->
        <?php require __DIR__ . '/php/blocks/modal.php'; ?>
        <script type="module" src="assets/js/main.js"></script>
    </body>
</html>
