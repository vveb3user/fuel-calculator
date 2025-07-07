export function validateInn(inn) {
    return /^[0-9]{12}$/.test(inn);
}

export function validatePhone(phone) {
    let digits = phone.replace(/\D/g, '');
    if (digits.startsWith('8')) digits = digits.slice(1);
    if (digits.startsWith('7')) digits = digits.slice(1);
    return digits.length === 10;
}

export function validateEmail(email) {
    return /^\S+@\S+\.\S+$/.test(email);
}

export function validateAgreement(agree) {
    return !!agree;
}

export function validateModalForm(form) {
    const inn = form.elements['inn'].value.trim();
    const phone = form.elements['phone'].value.trim();
    const email = form.elements['email'].value.trim();
    const agree = form.elements['agree'].checked;
    if (!validateInn(inn)) {
        return 'ИНН должен содержать ровно 12 цифр';
    }
    if (!validatePhone(phone)) {
        return 'Телефон должен содержать ровно 10 цифр после +7';
    }
    if (!validateEmail(email)) {
        return 'Введите корректный e-mail';
    }
    if (!validateAgreement(agree)) {
        return 'Необходимо согласиться с обработкой персональных данных';
    }
    return null;
}
