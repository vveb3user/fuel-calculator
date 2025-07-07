// Элементы summary
const tariffText = document.querySelector('.summary__tariff-text');
const promoButtons = document.querySelectorAll('.summary__promo-btn');
const yearlySavings = document.querySelector('.summary__savings-value--year');
const monthlySavings = document.querySelector('.summary__savings-value--month');
const orderButton = document.querySelector('.summary__order-button');
const orderButtonText = orderButton ? orderButton.querySelector('.summary__order-text') : null;

let selectedPromo = null;

// Обновление блока summary
export function updateSummary(data, currentPromo) {
    const tariffNames = {
        'economy': 'Эконом',
        'selected': 'Избранный',
        'premium': 'Премиум'
    };

    if (tariffText) {
        tariffText.textContent = tariffNames[data.tariff] || 'Избранный';
    }

    if (orderButtonText) {
        orderButtonText.textContent = `Заказать тариф «${tariffNames[data.tariff] || 'Избранный'}»`;
    }

    updatePromoButtons(data.availablePromos, currentPromo);

    if (yearlySavings) {
        yearlySavings.textContent = `${formatNumber(data.yearlySavings)} ₽`;
    }
    if (monthlySavings) {
        monthlySavings.textContent = `${formatNumber(data.monthlySavings)} ₽`;
    }
}

// Обновление промо-кнопок
function updatePromoButtons(availablePromos, currentPromo) {
    let promoToSelect = availablePromos.includes(currentPromo)
        ? currentPromo
        : Math.max(...availablePromos);
    promoButtons.forEach(btn => {
        const percent = parseInt(btn.querySelector('.summary__promo-percent').textContent);
        if (availablePromos.includes(percent)) {
            btn.classList.remove('summary__promo-btn--disabled');
            if (percent === promoToSelect) {
                btn.classList.add('summary__promo-btn--active');
            } else {
                btn.classList.remove('summary__promo-btn--active');
            }
        } else {
            btn.classList.add('summary__promo-btn--disabled');
            btn.classList.remove('summary__promo-btn--active');
        }
    });
}

// Форматирование чисел
function formatNumber(num) {
    if (num >= 100000000) {
        // Больше 100 млн — только целое число
        return `${Math.floor(num / 1000000)} млн`;
    } else if (num >= 10000000) {
        // От 10 млн до 100 млн — с десятыми
        let millions = Math.floor(num / 100000) / 10;
        return millions % 1 === 0
            ? `${millions.toFixed(0)} млн`
            : `${millions.toFixed(1)} млн`;
    }
    return new Intl.NumberFormat('ru-RU').format(num);
}

// Обработчики кликов по промо-кнопкам
promoButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        if (btn.classList.contains('summary__promo-btn--disabled')) return;
        promoButtons.forEach(b => b.classList.remove('summary__promo-btn--active'));
        btn.classList.add('summary__promo-btn--active');
        selectedPromo = parseInt(btn.querySelector('.summary__promo-percent').textContent);
        // Можно вызвать кастомное событие, если нужно оповестить calculator.js
        const event = new CustomEvent('promoSelected', { detail: { promo: selectedPromo } });
        btn.dispatchEvent(event);
    });
}); 