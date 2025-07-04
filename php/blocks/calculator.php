<div class="calculator">
    <!-- Заголовок -->
    <h1 class="calculator__title">Калькулятор тарифов</h1>
    <!-- Селект региона -->
    <div class="calculator__region-select select-region">
        <label class="select-region__label" for="region">Укажите регион проживания</label>
        <div class="select-region__wrapper">
            <select class="select-region__select" id="region" name="region">
                <option value="" disabled selected>Выберите регион</option>
                <?php
                $regions = require __DIR__ . '/../regions.php';
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
    <div class="calculator__fuel-type fuel-type">
        <div class="fuel-type__switcher">
            <input type="radio" id="fuel-petrol" name="fuel-type" value="petrol" class="fuel-type__input" checked>
            <label for="fuel-petrol" class="fuel-type__label">Бензин</label>
            <input type="radio" id="fuel-gas" name="fuel-type" value="gas" class="fuel-type__input">
            <label for="fuel-gas" class="fuel-type__label">Газ</label>
            <input type="radio" id="fuel-dt" name="fuel-type" value="dt" class="fuel-type__input">
            <label for="fuel-dt" class="fuel-type__label">ДТ</label>
        </div>
    </div>
    <!-- Выбор бренда -->
    <div class="calculator__brands brands">
        <div class="brands__title">Укажите любимый бренд</div>
        <div class="brands__list">
            <button type="button" class="brands__button" title="Shell">
                <!-- [svg] -->
                <span class="brands__name">Shell</span>
            </button>
            <button type="button" class="brands__button" title="Газпром">
                <!-- [svg] -->
                <span class="brands__name">Газпром</span>
            </button>
            <button type="button" class="brands__button" title="Роснефть">
                <!-- [svg] -->
                <span class="brands__name">Роснефть</span>
            </button>
            <button type="button" class="brands__button" title="Татнефть">
                <!-- [svg] -->
                <span class="brands__name">Татнефть</span>
            </button>
            <button type="button" class="brands__button" title="Лукойл">
                <!-- [svg] -->
                <span class="brands__name">Лукойл</span>
            </button>
            <button type="button" class="brands__button" title="Башнефть">
                <!-- [svg] -->
                <span class="brands__name">Башнефть</span>
            </button>
        </div>
    </div>
    <!-- Дополнительные услуги -->
    <div class="calculator__services services">
        <div class="services__title">Дополнительные услуги</div>
        <div class="services__list">
            <button type="button" class="services__button" title="Штрафы">
                <!-- [svg] -->
                <span class="services__name">Штрафы</span>
            </button>
            <button type="button" class="services__button" title="Парковки">
                <!-- [svg] -->
                <span class="services__name">Парковки</span>
            </button>
            <button type="button" class="services__button" title="ЭДО">
                <!-- [svg] -->
                <span class="services__name">ЭДО</span>
            </button>
            <button type="button" class="services__button" title="Мойки">
                <!-- [svg] -->
                <span class="services__name">Мойки</span>
            </button>
            <button type="button" class="services__button" title="Отчёты">
                <!-- [svg] -->
                <span class="services__name">Отчёты</span>
            </button>
            <button type="button" class="services__button" title="Телематика">
                <!-- [svg] -->
                <span class="services__name">Телематика</span>
            </button>
            <button type="button" class="services__button" title="PPRPAY">
                <!-- [svg] -->
                <span class="services__name">PPRPAY</span>
            </button>
            <button type="button" class="services__button" title="СМС">
                <!-- [svg] -->
                <span class="services__name">СМС</span>
            </button>
            <button type="button" class="services__button" title="Страхование">
                <!-- [svg] -->
                <span class="services__name">Страхование</span>
            </button>
        </div>
    </div>
</div> 