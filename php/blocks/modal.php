<div class="modal" id="order-modal">
    <div class="modal__content">
        <button type="button" class="modal__close" aria-label="Закрыть">
            <svg viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L14 14M14 14L1 27M14 14L27 27M14 14L27 1" stroke="currentColor" stroke-width="2"/>
            </svg>
        </button>
        <h2 class="modal__title">Заказать тариф<br>«Избранный»</h2>
        <form class="modal__form" novalidate>
            <div class="modal__field">
                <input type="text" class="modal__input" name="inn" placeholder="Номер ИНН" maxlength="12">
            </div>
            <div class="modal__field">
                <input type="text" class="modal__input" name="phone" placeholder="Телефон для связи" maxlength="18">
            </div>
            <div class="modal__field">
                <input type="text" class="modal__input" name="email" placeholder="E-mail для связи">
            </div>
            <div class="modal__checkbox-block">
                <label class="modal__checkbox-label">
                    <input type="checkbox" class="modal__checkbox" name="agree" checked>
                    <span class="modal__checkbox-custom"></span>
                    Согласен с обработкой персональных данных
                </label>
            </div>
            <button type="submit" class="button modal__submit">
                Заказать тариф «Избранный»
            </button>
        </form>
        <div class="modal__message"></div>
    </div>
</div> 