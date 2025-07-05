<div class="calculator">
    <!-- Заголовок -->
    <h1 class="calculator__title">Калькулятор тарифов</h1>
    <!-- Селект региона -->
    <div class="calculator__region-select select-region">
        <div class="select-region__wrapper">
            <label class="select-region__label" for="region">Укажите регион передвижения</label>
            <div class="select-region__select" id="region" name="region">
                <span class="select-region__value">Выберите регион</span>
            </div>
            <div class="select-region__dropdown">
                <?php
                $regions = require __DIR__ . '/../regions.php';
                $regionLimits = [];
                foreach ($regions as $region) {
                    $regionLimits[$region['id']] = $region['limit'];
                }
                ?>
                <?php foreach ($regions as $region): ?>
                    <div class="select-region__option" data-value="<?= htmlspecialchars($region['id']) ?>">
                        <?= htmlspecialchars($region['name']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <img class="select-region__arrow" src="assets/images/svg/arrow-down.svg" alt=""/>
    </div>
    <!-- Слайдер прокачки -->
    <div class="calculator__volume-slider volume-slider">
        <label class="volume-slider__label" for="volume">Прокачка</label>
        <span class="volume-slider__value">200 тонн</span>
    </div>
    <div class="volume-slider__input-wrapper">
        <input type="range" class="volume-slider__input" id="volume" name="volume" min="0" max="1200" value="200">
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
            <div class="fuel-type__slider"></div>
        </div>
    </div>
    <!-- Выбор бренда -->
    <div class="calculator__brands brands">
        <div class="brands__title">Укажите любимый бренд</div>
        <div class="circle-list brands__list">
            <button class="circle-list__item brands__button brands__button--active">
                <span class="circle-list__icon brands__icon">
                    <img src="assets/images/svg/shell-logo.svg" alt="Shell" />
                </span>
                <span class="circle-list__name brands__name">Shell</span>
            </button>
            <button class="circle-list__item brands__button">
                <span class="circle-list__icon brands__icon">
                    <img src="assets/images/svg/gazprom-logo.svg" alt="Газпром" />
                </span>
                <span class="circle-list__name brands__name">Газпром</span>
            </button>
            <button class="circle-list__item brands__button">
                <span class="circle-list__icon brands__icon">
                    <img src="assets/images/svg/rosneft-logo.svg" alt="Роснефть" />
                </span>
                <span class="circle-list__name brands__name">Роснефть</span>
            </button>
            <button class="circle-list__item brands__button">
                <span class="circle-list__icon brands__icon">
                    <img src="assets/images/svg/tatneft-logo.svg" alt="Татнефть" />
                </span>
                <span class="circle-list__name brands__name">Татнефть</span>
            </button>
            <button class="circle-list__item brands__button">
                <span class="circle-list__icon brands__icon">
                    <img src="assets/images/svg/lukoil-logo.svg" alt="Лукойл" />
                </span>
                <span class="circle-list__name brands__name">Лукойл</span>
            </button>
            <button class="circle-list__item brands__button">
                <span class="circle-list__icon brands__icon">
                    <img src="assets/images/svg/bashneft-logo.svg" alt="Башнефть" />
                </span>
                <span class="circle-list__name brands__name">Башнефть</span>
            </button>
        </div>
    </div>
    <!-- Блок дополнительных услуг -->
    <div class="calculator__services services">
        <div class="services__title">Дополнительные услуги</div>
        <div class="circle-list services__list">
            <button type="button" class="circle-list__item services__button" title="Штрафы">
                <span class="circle-list__icon services__icon">
                    <img src="assets/images/svg/fines.svg" alt="Штрафы" />
                </span>
                <span class="circle-list__name services__name">Штрафы</span>
            </button>
            <button type="button" class="circle-list__item services__button" title="Парковки">
                <span class="circle-list__icon services__icon">
                    <img src="assets/images/svg/parking.svg" alt="Парковки" />
                </span>
                <span class="circle-list__name services__name">Парковки</span>
            </button>
            <button type="button" class="circle-list__item services__button" title="ЭДО">
                <span class="circle-list__icon services__icon">
                    <img src="assets/images/svg/edo.svg" alt="ЭДО" />
                </span>
                <span class="circle-list__name services__name">ЭДО</span>
            </button>
            <button type="button" class="circle-list__item services__button" title="Мойки">
                <span class="circle-list__icon services__icon">
                    <img src="assets/images/svg/drop.svg" alt="Мойки" />
                </span>
                <span class="circle-list__name services__name">Мойки</span>
            </button>
            <button type="button" class="circle-list__item services__button" title="Отчёты">
                <span class="circle-list__icon services__icon">
                    <img src="assets/images/svg/clock.svg" alt="Отчёты" />
                </span>
                <span class="circle-list__name services__name">Отчёты</span>
            </button>
            <button type="button" class="circle-list__item services__button" title="Телематика">
                <span class="circle-list__icon services__icon">
                    <img src="assets/images/svg/telemat.svg" alt="Телематика" />
                </span>
                <span class="circle-list__name services__name">Телематика</span>
            </button>
            <button type="button" class="circle-list__item services__button" title="PPRPAY">
                <span class="circle-list__icon services__icon">
                    <img src="assets/images/svg/pprpay.svg" alt="PPRPAY" />
                </span>
                <span class="circle-list__name services__name">PPRPAY</span>
            </button>
            <button type="button" class="circle-list__item services__button" title="СМС">
                <span class="circle-list__icon services__icon">
                    <img src="assets/images/svg/message.svg" alt="СМС" />
                </span>
                <span class="circle-list__name services__name">СМС</span>
            </button>
            <button type="button" class="circle-list__item services__button" title="Страхование">
                <span class="circle-list__icon services__icon">
                    <img src="assets/images/svg/insuarence.svg" alt="Страхование" />
                </span>
                <span class="circle-list__name services__name">Страхование</span>
            </button>
        </div>
    </div>
</div>
<script>
window.regionLimits = <?php echo json_encode($regionLimits, JSON_UNESCAPED_UNICODE); ?>;
</script> 