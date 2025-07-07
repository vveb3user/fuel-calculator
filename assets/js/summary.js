// Элементы summary
const tariffText = document.querySelector('.summary__tariff-text');
const promoButtons = document.querySelectorAll('.summary__promo-btn');
const yearlySavings = document.querySelector('.summary__savings-value--year');
const monthlySavings = document.querySelector('.summary__savings-value--month');
const orderButton = document.querySelector('.summary__order-button');

let selectedPromo = null;

// Обновление блока summary
export function updateSummary(data) {
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

// Обновление промо-кнопок
function updatePromoButtons(availablePromos) {
    let maxPromo = Math.max(...availablePromos);
    promoButtons.forEach(btn => {
        const percent = parseInt(btn.querySelector('.summary__promo-percent').textContent);
        if (availablePromos.includes(percent)) {
            btn.classList.remove('summary__promo-btn--disabled');
            if (percent === maxPromo) {
                btn.classList.add('summary__promo-btn--active');
                selectedPromo = percent;
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