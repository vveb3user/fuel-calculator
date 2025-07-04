document.addEventListener('DOMContentLoaded', function() {
    const regionLimits = window.regionLimits || {};

    const slider = document.querySelector('.volume-slider__input');
    const valueSpan = document.querySelector('.volume-slider__value');
    const midSpan = document.querySelector('.volume-slider__mid');
    const maxSpan = document.querySelector('.volume-slider__max');

    const fuelInputs = document.querySelectorAll('.fuel-type__input');
    const fuelSlider = document.querySelector('.fuel-type__slider');
    function updateFuelSlider() {
        const checkedIndex = Array.from(fuelInputs).findIndex(input => input.checked);
        if (fuelSlider && checkedIndex >= 0) {
            fuelSlider.style.left = (checkedIndex * 33.3333) + '%';
        }
    }
    fuelInputs.forEach(input => {
        input.addEventListener('change', updateFuelSlider);
    });
    updateFuelSlider();

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