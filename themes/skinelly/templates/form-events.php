<div id="popup-events" class="modal modal_events" style="display: none">
    <div class="modal__content">
        <form class="form form-modal fetch">
            <div class="form__title">Записаться</div>
            <div class="form__input">
                <input type="text" name="name" placeholder="Ваше имя" autocomplete="off">
                <span class="form__input__placeholder">Имя</span>
            </div>
            <div class="form__input">
                <input type="tel" name="phone" class="phone-mask" placeholder="Телефон" autocomplete="off" required>
                <span class="form__input__placeholder">Номер телефона</span>
            </div>
            <div class="form__policy">
                <input type="checkbox" id="agreed" name="agreed" value="y" checked>
                <label for="agreed">
                    <span>Заполняя форму, вы принимаете условия <a href="">политики конфединциальности</a></span>
                </label>
            </div>
            <div class="form__input">
                <button type="submit" class="button button_white">Отправить</button>
            </div>
            <div class="form__hidden">
                <input type="hidden" name="email_title" value="Записаться на мероприятие">
                <input type="hidden" name="events_name" value="<?= (get_meta($id)["h1"]) ? get_meta($id)["h1"] : the_title(); ?>">
                <input type="hidden" name="ya_goal">
            </div>
        </form>
    </div>
</div>