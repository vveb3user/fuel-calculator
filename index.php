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
                    <div class="calculator__region-select"></div>
                    <!-- Слайдер прокачки -->
                    <div class="calculator__volume-slider"></div>
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
