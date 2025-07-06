<!-- Модальное окно заказа тарифа -->
<div class="modal" id="order-modal" style="display:none;">
    <div class="modal__content">
        <button type="button" class="modal__close" aria-label="Закрыть">&times;</button>
        <h2 class="modal__title">Заказать тариф<br>«Избранный»</h2>
        <form class="modal__form">
            <div class="modal__field">
                <input type="text" class="modal__input" name="inn" placeholder="Номер ИНН" maxlength="12" required>
            </div>
            <div class="modal__field">
                <input type="text" class="modal__input" name="phone" placeholder="Телефон для связи" maxlength="11" required>
            </div>
            <div class="modal__field">
                <input type="email" class="modal__input" name="email" placeholder="E-mail для связи" required>
            </div>
            <div class="modal__checkbox-block">
                <label class="modal__checkbox-label">
                    <input type="checkbox" class="modal__checkbox" name="agree" required checked>
                    <span class="modal__checkbox-custom"></span>
                    Согласен с обработкой персональных данных
                </label>
            </div>
            <button type="submit" class="modal__submit">
                Заказать тариф «Избранный»
            </button>
        </form>
        <div class="modal__message"></div>
    </div>
</div> 