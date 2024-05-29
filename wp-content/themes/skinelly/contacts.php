<?php /* Template Name: Контакты */
get_header();
$id = get_the_ID();
?>

<div class="contacts">
	<div class="container">
		<div class="contacts-header">
			<div class="title-section">
				<h1><?= get_meta($id)["h1"]; ?></h1>
			</div>
		</div>

		<div class="contacts-wrap">

			<div class="row">

				<div class="contacts-main">
					<div class="contacts-main__header">
						<h4>мы на связи!</h4>
						<p>Оставьте Вашу заявку, и мы свяжемся с Вами.</p>
                        <br>
					</div>

					<div class="contacts-main__form contacts-main__form-desktop">
						<form class="form fetch">
                             <input type="hidden" name="form_id" value="8">
							<div class="contacts-main__form__row">
								<div class="contacts-main__form__col-1">
									<div class="form__input">
										<input type="text" name="name" placeholder="Ваше имя">
									</div>
									<div class="form__input">
										<input type="tel" name="phone" placeholder="Номер телефона" inputmode="text">
									</div>
									<div class="form__submit">
										<input type="submit" value="отправить">
									</div>
								</div>
								<div class="contacts-main__form__col-2">
									<div class="form__input">
										<textarea name="question" placeholder="Опишите Ваш запрос"></textarea>
									</div>
								</div>
							</div>
							<div class="form__hidden">
								<input type="hidden" name="email_title" value="Форма заявки на странице контактов">
								<input type="hidden" name="ya_goal">
							</div>

						</form>
					</div>

					<div class="contacts-main__form contacts-main__form-mobile">
						<form class="form fetch">
							<div class="contacts-main__form__row">
								<div class="form__input">
									<input type="text" name="name" placeholder="Ваше имя">
								</div>
								<div class="form__input">
									<input type="tel" name="phone" placeholder="Номер телефона" inputmode="text">
								</div>
								<div class="form__input">
									<textarea name="question" placeholder="Опишите Ваш запрос"></textarea>
								</div>
								<div class="form__submit">
									<input type="submit" value="отправить" class="button button_white">
								</div>
							</div>
							<div class="form__hidden">
								<input type="hidden" name="email_title" value="Форма заявки на странице контактов">
								<input type="hidden" name="ya_goal">
							</div>

						</form>
					</div>

				</div>

				<div class="contacts-info">
					<h4>Skinelly в Москве</h4>
					<p>Адрес: г. Москва, 123100 улица Сергея Макеева, 7с2</p>
					<p>Контактный телефон: <a href="<? echo get_phone_link(get_field("phone", 'options')); ?>"><? the_field("phone", 'options'); ?></a></p>
					<p>ООО «Сила Красоты»</p>
					<p>E-mail: <a href="mailto:info@skinelly.ru">info@skinelly.ru</a></p>
					<div class="contacts-info__button">
						<button class="button button-blue modal-link" data-href="#popup">ЗАКАЗАТЬ ЗВОНОК</button>
					</div>

				</div>

			</div>

		</div>

	</div>
</div>


<?php get_footer(); ?>
