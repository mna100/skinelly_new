<?php
	/*  Карточка товара действующая*/
	get_header();
	$id = get_the_ID();

	$cardResult   = get_field("result_img", $id);
	$videofile    = get_field("product_video", $id);
	$videopreview = get_field("product_video_preview", $id);

	(get_field("product_color", $id)) ? $colorProduct = get_field("product_color", $id)
		: $colorProduct = $color;
?>
<style>
    body {
        --product-color: <?= $colorProduct; ?>
    }
</style>
<div class="card">
    <div class="container">
		<? //описание + слайдер?>
        <div class="about mb-block">
			<? $slider = get_field("products_slider", $id); ?>
			<? if ($slider): ?>
                <div class="slider">
                    <div class="swiper slider__big ">
                        <div class="swiper-wrapper">
							<? foreach ($slider as $cat) : ?>
                                <div class="swiper-slide">
                                    <img class="lozad"
                                         data-src="<?= $cat['img']["url"]; ?>"
                                         alt="<?= $cat['img']["alt"]; ?>"
                                         title="<?= $cat['img']["title"]; ?>">
                                </div>
							<? endforeach; ?>
                        </div>

                    </div>
                    <div class="slider__small-wrap">
                        <div thumbsSlider="" class="swiper slider__small">
                            <div class="swiper-wrapper">
								<? foreach ($slider as $cat) : ?>
                                    <div class="swiper-slide">
                                        <img class="lozad"
                                             data-src="<?= $cat['img']['url']; ?>"
                                             alt="<?= $cat['img']["alt"]; ?>"
                                             title="<?= $cat['img']["title"]; ?>">
                                    </div>
								<? endforeach; ?>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                </div>
			<? endif; ?>

            <div class="description">
                <div class="description__inner">
                    <h1><? the_field("seo_meta_page_h1", $id); ?></h1>
					<? if (get_field("products_text", $id)) : ?>
                        <div class="description__text editor">
							<? the_field("products_text", $id); ?>
                        </div>
					<? endif; ?>
                    <a href="#form-cost" class="button" style="border-color:<?= $colorProduct; ?>;background:<?= $colorProduct; ?>">Узнать
                        стоимость</a>
                </div>
            </div>
        </div>
		<? //контейнеры табы?>
        <div class="card-main mb-block">
			<? //табы?>
            <div class="card-tabs <?= ($videofile) ? '' : ' card-tabs_empty'; ?>">
                <span class="card-tab card-tab-active" data-tab="0">ХАРАКТЕРИСТИКИ ПРЕПАРАТА</span>
                <span class="card-tab" data-tab="1">ПОКАЗАНИЯ</span>
				<? if (!get_field("injection_check", $id)): ?>
                    <span class="card-tab" data-tab="2">ОБЛАСТИ И ТЕХНИКА ВВЕДЕНИЯ</span>
				<? endif; ?>
				<? if ($videofile) : ?>
                    <span class="card-tab" data-tab="3">Видео</span>
				<? endif; ?>
				<? if ($cardResult) : ?>
                    <span class="card-tab" data-tab="4">РЕЗУЛЬТАТЫ</span>
				<? endif; ?>
            </div>

			<? //контейнеры?>
            <div class="card-tabs__container mb-block">

				<? //контейнеры ХАРАКТЕРИСТИКИ ПРЕПАРАТА?>
                <div class="card-tab-mobile" data-tab-mobile="0">ХАРАКТЕРИСТИКИ ПРЕПАРАТА
                    <span class="card-tab-mobile__arrow">
                        <svg width="14" height="7" viewBox="0 0 14 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L7 6L13 1" stroke="#383838"/></svg>
                    </span>
                </div>

                <div class="card-tabs__inner" data-tab-container="0">
                    <div class="card-chars">
						<? $chars = get_field("product_chars", $id); ?>
						<? if ($chars): ?>
                            <div class="card-chars__table">
								<? foreach ($chars as $item) : ?>
                                    <div class="card-chars-row">
                                        <div class="card-chars-td card-chars-name">
											<?= $item["left"]; ?>
                                        </div>
                                        <div class="card-chars-td card-chars-value">
											<?= $item["right"]; ?>
                                        </div>
                                    </div>
								<? endforeach; ?>
                            </div>
						<? endif; ?>
						<? if (get_field("product_chars_img", $id)): ?>
                            <div class="card-chars__img">
                                <img class="lozad" data-fancybox
                                     data-src="<?= get_field("product_chars_img", $id)['url']; ?>"
                                     alt="<?= get_field("product_chars_img", $id)['alt']; ?>"
                                     title="<?= get_field("product_chars_img", $id)['title']; ?>">
                            </div>
						<? endif; ?>
                    </div>
                </div>
                <script>
                    if (window.innerWidth > 912)
                        document.querySelector('[data-tab-container="0"]').classList.add('card-tabs__inner--active');
                </script>
				<? //контейнеры ПОКАЗАНИЯ?>
                <div class="card-tab-mobile" data-tab-mobile="1">ПОКАЗАНИЯ
                    <span class="card-tab-mobile__arrow">
                        <svg width="14" height="7" viewBox="0 0 14 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L7 6L13 1" stroke="#383838"/></svg>
                    </span>
                </div>
                <div class="card-tabs__inner" data-tab-container="1">
                    <div class="card-testimony">
                        <div class="card-testimony__photo">
                            <img class="lozad" data-src="<? the_field("testimony_image", $id); ?>" data-fancybox alt="ПОКАЗАНИЯ">
                        </div>

                        <div class="card-testimony__info editor">
                            <div class="card-testimony__text">
								<? the_field("testimony_text", $id); ?>
                            </div>
                        </div>
                    </div>
                </div>

				<? //контейнеры ОБЛАСТИ И ТЕХНИКА ВВЕДЕНИЯ?>
				<? if (!get_field("injection_check", $id)): ?>
                    <div class="card-tab-mobile" data-tab-mobile="2">ОБЛАСТИ И ТЕХНИКА ВВЕДЕНИЯ
                        <span class="card-tab-mobile__arrow">
                        <svg width="14" height="7" viewBox="0 0 14 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L7 6L13 1" stroke="#383838"/></svg>
                    </span></div>
                    <div class="card-tabs__inner" data-tab-container="2">
                        <div class="card-injection">
							<? //левый блок?>
                            <div class="card-injection__l">

								<? //верх?>
                                <div class="card-injection__block">
									<? $injectionTop = get_field("injection", $id); ?>
									<? if ($injectionTop): ?>
										<? if (get_field("injection_title", $id)): ?>
                                            <div class="card-injection__subtitle">
												<? the_field("injection_title", $id); ?>
                                            </div>
										<? endif; ?>
                                        <div class="card-injection__top">
											<? foreach ($injectionTop as $key => $item): ?>
                                                <div class="card-injection__item">
                                                    <img class="lozad" data-fancybox="gallery"
                                                         data-src="<?= $item['img']['url'] ?>"
                                                         alt="<?= $item['img']['alt'] ?>"
                                                         title="<?= $item['img']['title'] ?>">
                                                    <span><?= $item['text']; ?></span>
                                                </div>
											<? endforeach; ?>
                                        </div>
									<? endif; ?>

									<? //низ?>
									<? if (get_field("cource_text", $id)): ?>
                                        <div class="card-injection__bottom">
											<? if (get_field("cource_title", $id)): ?>
                                                <div class="card-injection__subtitle">
													<? the_field("cource_title", $id); ?>
                                                </div>
											<? endif; ?>
                                            <div class="card-injection__bottom-text">
												<? the_field("cource_text", $id); ?>
                                            </div>
                                        </div>
									<? endif; ?>
                                </div>
                            </div>

							<? //правый блок?>
                            <div class="card-injection__r">
								<? if (get_field("technic_title", $id)): ?>
                                    <div class="card-injection__subtitle">
										<? the_field("technic_title", $id); ?>
                                    </div>
								<? endif; ?>
                                <div class="card-injection__r-content">
									<? if (get_field("technic_img", $id)): ?>
                                        <img class="lozad card-injection__r-img" data-fancybox
                                             data-src="<?= get_field("technic_img", $id)['url'] ?>"
                                             alt="<?= get_field("technic_img", $id)['alt'] ?>"
                                             title="<?= get_field("technic_img", $id)['title'] ?>">
									<? endif; ?>
									<? if (get_field("technic_text", $id)): ?>
                                        <div class="card-injection__r-text editor">
											<? the_field("technic_text", $id); ?>
                                        </div>
									<? endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
				<? endif; ?>
				<? //контейнеры ВИДЕО?>
				<? if ($videofile) : ?>
                    <div class="card-tab-mobile" data-tab-mobile="3">Видео
                        <span class="card-tab-mobile__arrow">
                        <svg width="14" height="7" viewBox="0 0 14 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L7 6L13 1" stroke="#383838"/></svg>
                    </span></div>
                    <div class="card-tabs__inner" data-tab-container="3">
                        <div class="card-video">
                            <div class="card-video__wrap">
								<? if ($videopreview) : ?>
                                    <div class="card-video__preview">
                                        <img src="<?= $videopreview; ?>" alt="">
                                    </div>
								<? endif; ?>
                                <div class="card-video__play">
                                    <svg width="166" height="193" viewBox="0 0 166 193" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M166 96.5L0.250002 0.804197L0.25 192.196L166 96.5Z" fill="#323232"/>
                                    </svg>
                                </div>
                                <div class="card-video__media">
                                    <video src="<?= $videofile; ?>" controls></video>
                                </div>
                            </div>
                        </div>
                    </div>
				<? endif; ?>

				<? //контейнеры РЕЗУЛЬТАТЫ?>
				<? if ($cardResult): ?>
                    <div class="card-tab-mobile" data-tab-mobile="4">
                        РЕЗУЛЬТАТЫ
                        <span class="card-tab-mobile__arrow">
                        <svg width="14" height="7" viewBox="0 0 14 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L7 6L13 1" stroke="#383838"/></svg>
                    </span></div>
                    <div class="card-tabs__inner" data-tab-container="4">
                        <div class="card-video card-video_result">
                            <img class="lozad card-injection__r-img" data-fancybox
                                 data-src="<?= $cardResult['url'] ?>"
                                 alt="<?= $cardResult['alt'] ?>"
                                 title="<?= $cardResult['title'] ?>">
                        </div>
                    </div>
				<? endif; ?>
            </div>


			<? //блок  категории?>
			<? $advantages = get_field("advantages", $id); ?>
			<? if ($advantages) : ?>
                <div class="advantages mb-block">

					<? if (get_field("advantages_subtitle", $id)) : ?>
                        <div class="title-section">
                            <h2><? the_field("advantages_subtitle", $id); ?></h2>
                        </div>
					<? endif; ?>

                    <div class="advantages__inner">
						<? foreach ($advantages as $key => $cat): ?>
                            <div class="advantages__card">
                                <span class="advantages__num"><?= $key + 1; ?></span>
                                <span class="advantages__text"><?= $cat["item"]; ?></span>
                            </div>
						<? endforeach; ?>
                    </div>
                </div>

			<? endif; ?>
        </div>
		<? include_once TEMPLATEPATH . '/templates/form.php'; ?>
    </div>
</div>
<?php get_footer(); ?>



