import { validateModalForm } from './validation.js';

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('order-modal');
    const openBtn = document.querySelector('.summary__order-button');
    const closeBtn = modal ? modal.querySelector('.modal__close') : null;
    const errorContainer = document.querySelector('.summary__order-error');
    const form = modal ? modal.querySelector('.modal__form') : null;
    const messageBox = modal ? modal.querySelector('.modal__message') : null;
    let errorMsg = null;

    function showError(msg) {
        if (!errorMsg) {
            errorMsg = document.createElement('div');
            errorMsg.className = 'order-error-msg';
            errorContainer.appendChild(errorMsg);
        }
        errorMsg.textContent = msg;
        errorMsg.style.color = '#FF3B30';
        errorMsg.style.marginTop = '12px';
        errorMsg.style.textAlign = 'center';
    }
    function clearError() {
        if (errorMsg) errorMsg.textContent = '';
    }

    function openModal() {
        if (modal) modal.classList.add('modal--open');
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        if (modal) modal.classList.remove('modal--open');
        document.body.style.overflow = '';
    }

    if (openBtn) {
        openBtn.addEventListener('click', function() {
            let regionSelected = false;
            let brandSelected = false;
            let selectedRegion = window.selectedRegion;
            if (typeof selectedRegion === 'undefined' || selectedRegion === null) {
                const regionInput = document.querySelector('.select-region__value');
                if (regionInput && regionInput.textContent && regionInput.textContent.trim() !== 'Выберите регион') {
                    regionSelected = true;
                }
            } else if (selectedRegion) {
                regionSelected = true;
            }
            const brandBtn = document.querySelector('.brands__button.brands__button--active');
            if (brandBtn) brandSelected = true;
            let msg = '';
            if (!regionSelected && !brandSelected) msg = 'Выберите регион и бренд';
            else if (!regionSelected) msg = 'Выберите регион';
            else if (!brandSelected) msg = 'Выберите бренд';
            if (msg) {
                showError(msg);
                return;
            }
            clearError();
            openModal();
        });
    }
    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });

    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            if (messageBox) messageBox.textContent = '';
            const error = validateModalForm(form);
            if (error) {
                if (messageBox) {
                    messageBox.textContent = error;
                    messageBox.style.color = '#FF3B30';
                }
                return;
            }
            const data = {
                inn: form.elements['inn'].value.trim(),
                phone: form.elements['phone'].value.trim(),
                email: form.elements['email'].value.trim(),
                agree: form.elements['agree'].checked
            };
            try {
                const response = await fetch('php/order.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                if (result.success) {
                    form.reset();
                    if (messageBox) {
                        messageBox.textContent = 'Спасибо! Успешно отправлено.';
                        messageBox.style.color = '#07DE44';
                    }
                } else {
                    if (messageBox) {
                        messageBox.textContent = 'Ошибка: ' + (result.error || 'Не удалось отправить');
                        messageBox.style.color = '#FF3B30';
                    }
                }
            } catch (err) {
                if (messageBox) {
                    messageBox.textContent = 'Ошибка: ' + err.message;
                    messageBox.style.color = '#FF3B30';
                }
            }
        });

        const phoneInput = form.elements['phone'];
        if (phoneInput) {
            // Маска телефона: +7 (XXX) XXX-XX-XX
            function formatPhone(value) {
                let digits = value.replace(/\D/g, '');
                if (digits.startsWith('8')) digits = digits.slice(1);
                if (digits.startsWith('7')) digits = digits.slice(1);
                digits = digits.slice(0, 10);
                let result = '+7';
                if (digits.length > 0) result += ' (' + digits.slice(0, 3);
                if (digits.length >= 4) result += ') ' + digits.slice(3, 6);
                if (digits.length >= 7) result += '-' + digits.slice(6, 8);
                if (digits.length >= 9) result += '-' + digits.slice(8, 10);
                return result;
            }
            phoneInput.addEventListener('input', function(e) {
                const oldStart = phoneInput.selectionStart;
                const oldLength = phoneInput.value.length;
                phoneInput.value = formatPhone(phoneInput.value);
                const newLength = phoneInput.value.length;
                phoneInput.selectionStart = phoneInput.selectionEnd = oldStart + (newLength - oldLength);
            });
            phoneInput.addEventListener('focus', function() {
                if (!phoneInput.value || phoneInput.value === '+7') {
                    phoneInput.value = '+7 (';
                    setTimeout(() => {
                        phoneInput.selectionStart = phoneInput.selectionEnd = phoneInput.value.length;
                    }, 0);
                }
            });
            phoneInput.addEventListener('blur', function() {
                if (phoneInput.value.replace(/\D/g, '').length < 10) {
                    phoneInput.value = '';
                }
            });
        }
    }
});
