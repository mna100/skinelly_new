<?php /* Template Name: Мероприятие */
	get_header();
	$id = get_the_ID();
?>

<div class="events events-post">
    <div class="container">

		<? //первый блок: заголовок  +иконки?>
        <div class="events__top mb-block">

            <div class="events__title-wrap">
                <h1 class="events__title"><?= (get_meta($id)["h1"]) ? get_meta($id)["h1"] : the_title(); ?></h1>
				<? if (get_field('theme_detile', $id)): ?>
                    <div class="events__subtitle"><?= get_field('theme_detile', $id); ?></div>
				<? endif; ?>
                <button class="button modal-link" data-href="#popup-events">Записаться</button>
            </div>

            <div class="events__icons-wrap">
				<? if (get_field('date', $id)): ?>
                    <div class="events__icons">
                        <img src="<?= get_template_directory_uri() . '/public/calendar.svg'; ?>" alt="дата">
                        <span><?= substr(get_field("date", $id), 0, -5); ?></span>
                    </div>
                    <div class="events__icons">
                        <img src="<?= get_template_directory_uri() . '/public/clock.svg'; ?>" alt="время">
                        <span><?= substr(get_field("date", $id), 0, 11); ?></span>
                    </div>
				<? endif; ?>
				<? if (get_field('condition', $id)): ?>
                    <div class="events__icons">
                        <img src="<?= get_template_directory_uri() . '/public/person.svg'; ?>" alt="Условие участия">
                        <span>Условие участия:<br>
						<?= get_field("condition", $id); ?>
                            </span>
                    </div>
				<? endif; ?>
				<? if (get_field('city', $id) || get_field('city', $id)): ?>
                    <div class="events__icons">
                        <img src="<?= get_template_directory_uri() . '/public/location.svg'; ?>" alt="Город">
                        <span>
                            <? if (get_field('city', $id)): ?>
								<?= get_field("city", $id); ?>
							<? endif; ?>
							<? if (get_field('address', $id)): ?>
                                ,&nbsp;<?= get_field("address", $id); ?>
							<? endif; ?>
                        </span>
                    </div>
				<? endif; ?>
                <button class="button modal-link button-events-mobile" data-href="#popup-events">Записаться</button>
            </div>
        </div>

		<? //второй блок?>
		<? if (get_field('speaker_img', $id) || get_field('speaker_text', $id)): ?>
            <div class="events__bottom mb-block">
				<? if (get_field('speaker_img', $id)): ?>
                    <div class="events__bottom-img">
                        <img src="<?= get_field('speaker_img', $id)['url'] ?>" alt="<?= get_field('speaker_img', $id)['alt'] ?>" title="<?= get_field('speaker_img', $id)['title'] ?>">
                    </div>
				<? endif; ?>
				<? if (get_field('speaker_text', $id)): ?>
                    <div class="events__bottom-text"><?= get_field('speaker_text', $id); ?></div>
				<? endif; ?>
            </div>
		<? endif; ?>

		<? //третий блок - основной контентент?>
        <div class="events__content editor">
			<? the_content(); ?>
        </div>

    </div>
</div>
<? include_once TEMPLATEPATH . '/templates/form-events.php'; ?>
<?php get_footer(); ?>
