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
        <header class="header">
            <div class="header__container">
                <div class="header__logo">
                    <!-- Логотип -->
                    <img src="assets/images/merck-logo.png" alt="MERCK" />
                </div>
                <nav class="header__nav">
                    <ul class="header__menu">
                        <li class="header__menu-item"><a href="#">Все топливные карты</a></li>
                        <li class="header__menu-item"><a href="#">Корпоративные карты</a></li>
                        <li class="header__menu-item"><a href="#">Подбор по регионам</a></li>
                        <li class="header__menu-item"><a href="#">Акции</a></li>
                        <li class="header__menu-item"><a href="#">Рейтинг и сравнение</a></li>
                        <li class="header__menu-item"><a href="#">Список справок</a></li>
                        <li class="header__menu-item"><a href="#">Отзывы</a></li>
                        <li class="header__menu-item"><a href="#">АЗС на карте</a></li>
                    </ul>
                </nav>
                <div class="header__actions">
                    <button class="header__button">Заказать карты</button>
                </div>
            </div>
        </header>
        <!-- Основной контейнер калькулятора -->
        <main class="calculator">
            <div class="calculator__container">
                <!-- Левая часть: форма калькулятора -->
                <section class="calculator__form">
                    <!-- Заголовок -->
                    <h1 class="calculator__title">Калькулятор тарифов</h1>
                    <!-- Селект региона -->
                    <div class="calculator__region-select select-region">
                        <label class="select-region__label" for="region">Укажите регион проживания</label>
                        <div class="select-region__wrapper">
                            <select class="select-region__select" id="region" name="region">
                                <option value="" disabled selected>Выберите регион</option>
                                <?php
                                // Список регионов для селекта
                                $regions = require __DIR__ . '/php/regions.php';
                                ?>
                                <?php foreach ($regions as $region): ?>
                                    <option value="<?= htmlspecialchars($region['id']) ?>"><?= htmlspecialchars($region['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- Слайдер прокачки -->
                    <div class="calculator__volume-slider volume-slider">
                        <label class="volume-slider__label" for="volume">Прокачка</label>
                        <div class="volume-slider__input-wrapper">
                            <input type="range" class="volume-slider__input" id="volume" name="volume" min="0" max="1200" value="200">
                            <span class="volume-slider__value">200 тонн</span>
                        </div>
                        <div class="volume-slider__scale">
                            <span class="volume-slider__min">0 тонн</span>
                            <span class="volume-slider__mid">250 тонн</span>
                            <span class="volume-slider__max">500+ тонн</span>
                        </div>
                    </div>
                    <!-- Переключатели топлива -->
                    <div class="calculator__fuel-type"></div>
                    <!-- Выбор бренда -->
                    <div class="calculator__brands"></div>
                    <!-- Дополнительные услуги -->
                    <div class="calculator__services"></div>
                </section>
                <!-- Правая часть: карточка, тариф, промо, экономия -->
                <aside class="calculator__summary">
                    <!-- Тариф -->
                    <div class="calculator__tariff"></div>
                    <!-- Карточка -->
                    <div class="calculator__card"></div>
                    <!-- Промо-акция -->
                    <div class="calculator__promo"></div>
                    <!-- Экономия -->
                    <div class="calculator__savings"></div>
                    <!-- Кнопка заказа -->
                    <div class="calculator__order"></div>
                </aside>
            </div>
        </main>
        <!-- Модальное окно -->
        <div class="modal" id="order-modal" style="display:none;">
            <div class="modal__content">
                <!-- Форма заказа тарифа -->
                <form class="modal__form">
                    <!-- Поля формы -->
                </form>
                <!-- Сообщение об успехе/ошибке -->
                <div class="modal__message"></div>
            </div>
        </div>
    </div>
</body>
</html>
