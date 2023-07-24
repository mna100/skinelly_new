<?
(get_field("product_color", $id)) ? $colorProduct = get_field("product_color", $id)
		: $colorProduct = $color;
?>
<div class="home-form mb-block" id="form-cost">
    <div class="container">

		<? if (get_field("form_title", 'options')) : ?>
            <div class="title-section">
                <h2><? the_field("form_title", 'options'); ?></h2>
            </div>
		<? endif; ?>

        <div class="home-form__wrap">

            <form class="form fetch" style="background: <?= $colorProduct; ?>">
                <input type="hidden" name="form_id" value="7">
                <div class="home-form__row">
                    <div class="home-form__col form__input">
                        <input type="text" name="name" placeholder="Ваше имя">
                        <span class="form__input__placeholder">Имя</span>
                    </div>
                    <div class="resize"></div>
                    <div class="home-form__col form__input">
                        <input type="tel" name="phone" placeholder="Номер телефона">
                        <span class="form__input__placeholder">Номер телефона</span>
                    </div>
                    <div class="resize"></div>
                    <div class="resize"></div>
                    <div class="home-form__col">
                        <input class="button  button_white" type="submit" value="<? the_field("form_btn", 'options'); ?>">
                    </div>
                </div>
				<? if (get_field("form_text", 'options')) : ?>
                    <span class="home-form__agree">
                       <? the_field("form_text", 'options'); ?>
                    </span>
				<? endif; ?>
                <div class="form__hidden">
                    <input type="hidden" name="email_title" value="Узнать стоимость">
                    <input type="hidden" name="ya_goal" value="price">
                </div>
            </form>
        </div>
    </div>
</div>
