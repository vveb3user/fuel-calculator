document.addEventListener('DOMContentLoaded', function() {
    const regionLimits = window.regionLimits || {};

    // Элементы слайдера прокачки
    const slider = document.querySelector('.volume-slider__input');
    const valueSpan = document.querySelector('.volume-slider__value');
    const midSpan = document.querySelector('.volume-slider__mid');
    const maxSpan = document.querySelector('.volume-slider__max');

    // Элементы summary блока
    const tariffText = document.querySelector('.summary__tariff-text');
    const promoButtons = document.querySelectorAll('.summary__promo-btn');
    const yearlySavings = document.querySelector('.summary__savings-value--year');
    const monthlySavings = document.querySelector('.summary__savings-value--month');
    const orderButton = document.querySelector('.summary__order-button');

    // Конфигурация брендов по типам топлива
    const fuelBrands = {
        petrol: ['rosneft', 'tatneft', 'lukoil'],
        gas: ['shell', 'gazprom', 'bashneft'],
        dt: ['tatneft', 'lukoil']
    };

    // Элементы управления
    const brandButtons = document.querySelectorAll('.brands__button');
    const fuelInputs = document.querySelectorAll('.fuel-type__input');
    const fuelSlider = document.querySelector('.fuel-type__slider');
    const serviceButtons = document.querySelectorAll('.services__button');
    
    // Состояние приложения
    let selectedFuel = 'petrol';
    let selectedBrand = null;
    let selectedServices = [];
    let selectedRegion = null;
    let selectedPromo = 50;

    // Обновление доступных брендов в зависимости от типа топлива
    function updateBrands() {
        const allowed = fuelBrands[selectedFuel];
        brandButtons.forEach(btn => {
            const brandKey = btn.dataset.brand;
            if (allowed.includes(brandKey)) {
                btn.classList.remove('is-disabled');
                btn.disabled = false;
            } else {
                btn.classList.add('is-disabled');
                btn.disabled = true;
                if (btn.classList.contains('brands__button--active')) {
                    btn.classList.remove('brands__button--active');
                    selectedBrand = null;
                }
            }
        });
    }

    // Обработчики переключения типа топлива
    fuelInputs.forEach(input => {
        input.addEventListener('change', e => {
            if (input.checked) {
                selectedFuel = input.value;
                updateBrands();
                updateFuelSlider();
                calculateCost();
            }
        });
    });

    // Обработчики выбора бренда
    brandButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            if (btn.classList.contains('is-disabled')) return;
            brandButtons.forEach(b => b.classList.remove('brands__button--active'));
            btn.classList.add('brands__button--active');
            selectedBrand = btn.querySelector('.brands__name').textContent.trim();
            calculateCost();
        });
    });

    // Обработчики выбора дополнительных услуг
    serviceButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const serviceName = btn.querySelector('.services__name').textContent.trim();
            
            if (btn.classList.contains('services__button--active')) {
                btn.classList.remove('services__button--active');
                selectedServices = selectedServices.filter(service => service !== serviceName);
            } else {
                if (selectedServices.length < 4) {
                    btn.classList.add('services__button--active');
                    selectedServices.push(serviceName);
                }
            }
            calculateCost();
        });
    });

    updateBrands();

    // Обновление позиции слайдера типа топлива
    function updateFuelSlider() {
        const checkedIndex = Array.from(fuelInputs).findIndex(input => input.checked);
        if (fuelSlider && checkedIndex >= 0) {
            fuelSlider.style.left = (checkedIndex * 33.3333) + '%';
        }
    }

    // Обновление отображения значения слайдера
    function updateValue() {
        if (valueSpan && slider) {
            valueSpan.textContent = slider.value + ' тонн';
        }
    }

    // Обновление прогресса слайдера
    function updateSliderProgress(slider) {
        const min = parseInt(slider.min) || 0;
        const max = parseInt(slider.max) || 100;
        const val = parseInt(slider.value) || 0;
        const percent = ((val - min) / (max - min)) * 100;
        slider.style.setProperty('--progress', percent + '%');
    }

    // Обновление лимитов слайдера в зависимости от региона
    function updateSliderLimits(regionId) {
        const max = regionLimits[regionId] || 500;
        const mid = Math.floor(max / 2);
        if (slider) {
            slider.max = max;
            if (parseInt(slider.value) > max) slider.value = max;
        }
        if (maxSpan) maxSpan.textContent = (max === 500 ? '500+ тонн' : max + '+ тонн');
        if (midSpan) midSpan.textContent = mid + ' тонн';
        updateValue();
        if (slider) updateSliderProgress(slider);
    }

    // Обработчик изменения слайдера прокачки
    if (slider) {
        slider.addEventListener('input', function() {
            updateValue();
            updateSliderProgress(slider);
            calculateCost();
        });
        updateValue();
        updateSliderProgress(slider);
    }

    // Обработчик выбора региона
    document.querySelectorAll('.select-region').forEach(region => {
        region.addEventListener('regionSelected', e => {
            selectedRegion = e.detail.id;
            updateSliderLimits(e.detail.id);
            calculateCost();
        });
    });

    // Расчет стоимости и обновление интерфейса
    async function calculateCost() {
        if (!selectedRegion || !selectedBrand) return;

        const data = {
            region: selectedRegion,
            volume: parseInt(slider.value),
            fuelType: selectedFuel,
            brand: selectedBrand,
            services: selectedServices,
            promoPercent: selectedPromo
        };

        try {
            const response = await fetch('php/calculate.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();
            
            if (result.success) {
                updateSummary(result.data);
            } else {
                console.error('Ошибка расчета:', result.error);
            }
        } catch (error) {
            console.error('Ошибка запроса:', error);
        }
    }

    // Обновление summary блока с результатами расчета
    function updateSummary(data) {
        const tariffNames = {
            'economy': 'Эконом',
            'selected': 'Избранный',
            'premium': 'Премиум'
        };
        
        if (tariffText) {
            tariffText.textContent = tariffNames[data.tariff] || 'Избранный';
        }

        if (orderButton) {
            orderButton.textContent = `Заказать тариф «${tariffNames[data.tariff] || 'Избранный'}»`;
        }

        updatePromoButtons(data.availablePromos);

        if (yearlySavings) {
            yearlySavings.textContent = `от ${formatNumber(data.yearlySavings)} ₽`;
        }
        if (monthlySavings) {
            monthlySavings.textContent = `от ${formatNumber(data.monthlySavings)} ₽`;
        }
    }

    // Обновление доступных промо-акций
    function updatePromoButtons(availablePromos) {
        promoButtons.forEach((btn, index) => {
            const percent = parseInt(btn.querySelector('.summary__promo-percent').textContent);
            if (availablePromos.includes(percent)) {
                btn.style.display = 'block';
                if (percent === Math.max(...availablePromos)) {
                    btn.classList.add('summary__promo-btn--active');
                    selectedPromo = percent;
                } else {
                    btn.classList.remove('summary__promo-btn--active');
                }
            } else {
                btn.style.display = 'none';
                btn.classList.remove('summary__promo-btn--active');
            }
        });
    }

    // Форматирование чисел в российском формате
    function formatNumber(num) {
        return new Intl.NumberFormat('ru-RU').format(num);
    }

    // Обработчики выбора промо-акций
    promoButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            promoButtons.forEach(b => b.classList.remove('summary__promo-btn--active'));
            btn.classList.add('summary__promo-btn--active');
            selectedPromo = parseInt(btn.querySelector('.summary__promo-percent').textContent);
            calculateCost();
        });
    });

    updateSliderLimits(null);
});