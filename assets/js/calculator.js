document.addEventListener('DOMContentLoaded', function() {
    const regionLimits = window.regionLimits || {};

    const slider = document.querySelector('.volume-slider__input');
    const valueSpan = document.querySelector('.volume-slider__value');
    const midSpan = document.querySelector('.volume-slider__mid');
    const maxSpan = document.querySelector('.volume-slider__max');

    const fuelTypes = {
        petrol: {
            price: 500200,
            brands: ['rosneft', 'tatneft', 'lukoil']
        },
        gas: {
            price: 200100,
            brands: ['shell', 'gazprom', 'bashneft']
        },
        dt: {
            price: 320700,
            brands: ['tatneft', 'lukoil']
        }
    };

    const brandButtons = document.querySelectorAll('.brands__button');
    const fuelInputs = document.querySelectorAll('.fuel-type__input');
    const fuelSlider = document.querySelector('.fuel-type__slider');
    const serviceButtons = document.querySelectorAll('.services__button');
    let selectedFuel = 'petrol';
    let selectedBrand = null;
    let selectedServices = [];

    function updateBrands() {
        const allowed = fuelTypes[selectedFuel].brands;
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

    fuelInputs.forEach(input => {
        input.addEventListener('change', e => {
            if (input.checked) {
                selectedFuel = input.value;
                updateBrands();
                updateFuelSlider();
            }
        });
    });

    brandButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            if (btn.classList.contains('is-disabled')) return;
            brandButtons.forEach(b => b.classList.remove('brands__button--active'));
            btn.classList.add('brands__button--active');
            selectedBrand = btn.querySelector('.brands__name').textContent.trim();
        });
    });

    serviceButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const serviceName = btn.querySelector('.services__name').textContent.trim();
            
            if (btn.classList.contains('services__button--active')) {
                // Убираем услугу из выбранных
                btn.classList.remove('services__button--active');
                selectedServices = selectedServices.filter(service => service !== serviceName);
            } else {
                // Добавляем услугу, если не превышен лимит
                if (selectedServices.length < 4) {
                    btn.classList.add('services__button--active');
                    selectedServices.push(serviceName);
                }
            }
        });
    });

    updateBrands();

    function updateFuelSlider() {
        const checkedIndex = Array.from(fuelInputs).findIndex(input => input.checked);
        if (fuelSlider && checkedIndex >= 0) {
            fuelSlider.style.left = (checkedIndex * 33.3333) + '%';
        }
    }

    function updateValue() {
        if (valueSpan && slider) {
            valueSpan.textContent = slider.value + ' тонн';
        }
    }

    function updateSliderProgress(slider) {
        const min = parseInt(slider.min) || 0;
        const max = parseInt(slider.max) || 100;
        const val = parseInt(slider.value) || 0;
        const percent = ((val - min) / (max - min)) * 100;
        slider.style.setProperty('--progress', percent + '%');
    }

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

    if (slider) {
        slider.addEventListener('input', function() {
            updateValue();
            updateSliderProgress(slider);
        });
        updateValue();
        updateSliderProgress(slider);
    }

    document.querySelectorAll('.select-region').forEach(region => {
        region.addEventListener('regionSelected', e => {
            updateSliderLimits(e.detail.id);
        });
    });

    updateSliderLimits(null);
});