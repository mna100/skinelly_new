<?php
	/*  Карточка товара действующая*/
	get_header();
	$id = get_the_ID();

	$cardResult   = get_field( "result", $id );
	$videofile    = get_field( "product_video", $id );
	$videopreview = get_field( "product_video_preview", $id );

	( get_field( "product_color", $id ) ) ? $colorProduct = get_field( "product_color", $id )
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
			<? $slider = get_field( "products_slider", $id ); ?>
			<? if ( $slider ): ?>
                <div class="slider">
                    <div class="swiper slider__big ">
                        <div class="swiper-wrapper">
							<? foreach ( $slider as $cat ) : ?>
                                <div class="swiper-slide">
                                    <img class="lozad"
                                         data-src="<?= $cat['img']["url"]; ?>"
                                         alt="<?= $cat['img']["alt"]; ?>"
                                         title="<?= $cat['img']["title"]; ?>">
                                </div>
							<? endforeach; ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div class="slider__small-wrap">
                        <div thumbsSlider="" class="swiper slider__small">
                            <div class="swiper-wrapper">
								<? foreach ( $slider as $cat ) : ?>
                                    <div class="swiper-slide">
                                        <img class="lozad"
                                             data-src="<?= $cat['img']['url']; ?>"
                                             alt="<?= $cat['img']["alt"]; ?>"
                                             title="<?= $cat['img']["title"]; ?>">
                                    </div>
								<? endforeach; ?>
                            </div>
                        </div>

                    </div>

                </div>
			<? endif; ?>

            <div class="description">
                <div class="description__inner">
                    <h1><? the_field( "seo_meta_page_h1", $id ); ?></h1>
					<? if ( get_field( "products_text", $id ) ) : ?>
                        <div class="description__text editor">
							<? the_field( "products_text", $id ); ?>
                        </div>
					<? endif; ?>
                    <a href="#form-cost" class="button" style="border-color:<?= $colorProduct; ?>;background:<?= $colorProduct; ?>">Узнать
                        стоимость</a>
					<?php if(get_field('инструкция')) { ?>
                        <a href="<?php echo get_field('инструкция'); ?>" target="_blank" class="button2">Инструкция</a>
                    <?php } ?>
                </div>
            </div>
        </div>
		<? //контейнеры табы?>
        <div class="card-main mb-block">
			<? //табы?>
            <div class="card-tabs <?= ( $videofile ) ? '' : ' card-tabs_empty'; ?>">
                <span class="card-tab card-tab-active" data-tab="0">ХАРАКТЕРИСТИКИ ПРЕПАРАТА</span>
                <span class="card-tab" data-tab="1">ПОКАЗАНИЯ</span>
				<? if ( ! get_field( "injection_check", $id ) ): ?>
                    <span class="card-tab" data-tab="2">ОБЛАСТИ И ТЕХНИКА ВВЕДЕНИЯ</span>
				<? endif; ?>
				<? if ( $videofile ) : ?>
                    <span class="card-tab" data-tab="3">Видео</span>
				<? endif; ?>
				<? if ( $cardResult ) : ?>
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
						<? $chars = get_field( "product_chars", $id ); ?>
						<? if ( $chars ): ?>
                            <div class="card-chars__table">
								<? foreach ( $chars as $item ) : ?>
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
						<? if ( get_field( "product_chars_img", $id ) ): ?>
                            <div class="card-chars__img">
                                <img class="lozad" data-fancybox
                                     data-src="<?= get_field( "product_chars_img", $id )['url']; ?>"
                                     alt="<?= get_field( "product_chars_img", $id )['alt']; ?>"
                                     title="<?= get_field( "product_chars_img", $id )['title']; ?>">
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
                            <img class="lozad" data-src="<? the_field( "testimony_image", $id ); ?>" data-fancybox alt="ПОКАЗАНИЯ">
                        </div>

                        <div class="card-testimony__info editor">
                            <div class="card-testimony__text">
								<? the_field( "testimony_text", $id ); ?>
                            </div>
                        </div>
                    </div>
                </div>

				<? //контейнеры ОБЛАСТИ И ТЕХНИКА ВВЕДЕНИЯ?>
				<? if ( ! get_field( "injection_check", $id ) ): ?>
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
									<? $injectionTop = get_field( "injection", $id ); ?>
									<? if ( $injectionTop ): ?>
										<? if ( get_field( "injection_title", $id ) ): ?>
                                            <div class="card-injection__subtitle">
												<? the_field( "injection_title", $id ); ?>
                                            </div>
										<? endif; ?>
                                        <div class="card-injection__top<?= ( get_field( "injection_full_img", $id ) )
											? ' card-injection__top_full-img' : ''; ?>">
											<? foreach ( $injectionTop as $key => $item ): ?>
                                                <div class="card-injection__item">
                                                    <img class="lozad" data-fancybox="gallery"
                                                         data-src="<?= $item['img']['url'] ?>"
                                                         alt="<?= $item['img']['alt'] ?>"
                                                         title="<?= $item['img']['title'] ?>">
													<? if ( $item['text'] ): ?>
                                                        <span><?= $item['text']; ?></span>
													<? endif; ?>
                                                </div>
											<? endforeach; ?>
                                        </div>
									<? endif; ?>

									<? //низ?>
									<? if ( get_field( "cource_text", $id ) ): ?>
                                        <div class="card-injection__bottom">
											<? if ( get_field( "cource_title", $id ) ): ?>
                                                <div class="card-injection__subtitle">
													<? the_field( "cource_title", $id ); ?>
                                                </div>
											<? endif; ?>
                                            <div class="card-injection__bottom-text">
												<? the_field( "cource_text", $id ); ?>
                                            </div>
                                        </div>
									<? endif; ?>
                                </div>
                            </div>

							<? //правый блок?>
                            <div class="card-injection__r">
								<? if ( get_field( "technic_title", $id ) ): ?>
                                    <div class="card-injection__subtitle">
										<? the_field( "technic_title", $id ); ?>
                                    </div>
								<? endif; ?>
                                <div class="card-injection__r-content">
									<? if ( get_field( "technic_img", $id ) ): ?>
                                        <img class="lozad card-injection__r-img" data-fancybox
                                             data-src="<?= get_field( "technic_img", $id )['url'] ?>"
                                             alt="<?= get_field( "technic_img", $id )['alt'] ?>"
                                             title="<?= get_field( "technic_img", $id )['title'] ?>">
									<? endif; ?>
									<? if ( get_field( "technic_text", $id ) ): ?>
                                        <div class="card-injection__r-text editor" <?= ( ! get_field( "technic_img", $id ) )
											? ' style="padding-left: 0;"' : ''; ?>>
											<? the_field( "technic_text", $id ); ?>
                                        </div>
									<? endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
				<? endif; ?>
				<? //контейнеры ВИДЕО?>
				<? if ( $videofile ) : ?>
                    <div class="card-tab-mobile" data-tab-mobile="3">Видео
                        <span class="card-tab-mobile__arrow">
                        <svg width="14" height="7" viewBox="0 0 14 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L7 6L13 1" stroke="#383838"/></svg>
                    </span></div>
                    <div class="card-tabs__inner" data-tab-container="3">
                        <div class="card-video">
                            <div class="card-video__wrap">
								<? if ( $videopreview ) : ?>
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
                <? if ( $cardResult ): ?>
                    <div class="card-tab-mobile" data-tab-mobile="4">
                        РЕЗУЛЬТАТЫ
                        <span class="card-tab-mobile__arrow">
                        <svg width="14" height="7" viewBox="0 0 14 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L7 6L13 1" stroke="#383838"/></svg>
                    </span></div>
                    <div class="card-tabs__inner tab-video" data-tab-container="4">
                        <div class="card-video card-video_result">
                            <?php $index=1; foreach($cardResult as $card) { ?>
                                <a ><img class="lozad card-injection__r-img" data-fancybox
                                 data-src="<?= $card['картинка']['url'] ?>"
                                 alt="<?= $card['картинка']['alt'] ?>"
                                 title="<?= $card['картинка']['title'] ?>"></a>
                                
                            <?php $index++; } ?>
                            <?php $index=1; foreach($cardResult as $card) { ?>
                              
                                 <div class="g">
                                            <img class="card-injection__r-img" 
                                             src="<?= $card['картинка']['url'] ?>"
                                             alt="<?= $card['картинка']['alt'] ?>"
                                             title="<?= $card['картинка']['title'] ?>">
                                             <div class="info">
                                                <?php foreach($card['информация'] as $i) { ?>
                                                    <p><span><?php echo $i['текст_1']; ?>:</span><?php echo $i['текст_2']; ?></p>
                                                <?php } ?>
                                            </div>
                                    </div>
                            <?php $index++; } ?>
                            
                        </div>
                        <div class="modalv" id="modal">
                            <div class="bg"></div>
                            <div class="content">
                               <div class="c"> <div class="close"><svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
<g clip-path="url(#clip0_1102_437)">
<path d="M1.46875 2.66973L2.66875 1.46973L19.4688 18.2697L36.2688 1.46973L37.4688 2.66973L20.6688 19.4697L37.4688 36.2697L36.2688 37.4697L19.4688 20.6697L2.66875 37.4697L1.46875 36.2697L18.2688 19.4697L1.46875 2.66973Z" fill="black"/>
<path d="M2.55103 3.75C2.97103 3.33 3.33103 2.97 3.75103 2.55C3.03103 2.55 2.31103 2.55 1.65103 2.55C7.23103 8.13 12.871 13.77 18.451 19.35C19.051 19.95 20.011 19.95 20.551 19.35C26.131 13.77 31.771 8.13 37.351 2.55C36.631 2.55 35.911 2.55 35.251 2.55C35.671 2.97 36.031 3.33 36.451 3.75C36.451 3.03 36.451 2.31 36.451 1.65C30.871 7.23 25.231 12.87 19.651 18.45C19.051 19.05 19.051 20.01 19.651 20.55C25.231 26.13 30.871 31.77 36.451 37.35C36.451 36.63 36.451 35.91 36.451 35.25C36.031 35.67 35.671 36.03 35.251 36.45C35.971 36.45 36.691 36.45 37.351 36.45C31.771 30.87 26.131 25.23 20.551 19.65C19.951 19.05 18.991 19.05 18.451 19.65C12.871 25.23 7.23103 30.87 1.65103 36.45C2.37103 36.45 3.09103 36.45 3.75103 36.45C3.33103 36.03 2.97103 35.67 2.55103 35.25C2.55103 35.97 2.55103 36.69 2.55103 37.35C8.13103 31.77 13.771 26.13 19.351 20.55C19.951 19.95 19.951 18.99 19.351 18.45C13.771 12.87 8.13103 7.23 2.55103 1.65C1.17103 0.27 -0.928974 2.43 0.451026 3.75C6.03103 9.33 11.671 14.97 17.251 20.55C17.251 19.83 17.251 19.11 17.251 18.45C11.671 24.03 6.03103 29.67 0.451026 35.25C-0.148974 35.85 -0.148974 36.81 0.451026 37.35C0.871026 37.77 1.23103 38.13 1.65103 38.55C2.25103 39.15 3.21103 39.15 3.75103 38.55C9.33103 32.97 14.971 27.33 20.551 21.75C19.831 21.75 19.111 21.75 18.451 21.75C24.031 27.33 29.671 32.97 35.251 38.55C35.851 39.15 36.811 39.15 37.351 38.55C37.771 38.13 38.131 37.77 38.551 37.35C39.151 36.75 39.151 35.79 38.551 35.25C32.971 29.67 27.331 24.03 21.751 18.45C21.751 19.17 21.751 19.89 21.751 20.55C27.331 14.97 32.971 9.33 38.551 3.75C39.151 3.15 39.151 2.19 38.551 1.65C38.131 1.23 37.771 0.87 37.351 0.45C36.751 -0.15 35.791 -0.15 35.251 0.45C29.671 6.03 24.031 11.67 18.451 17.25C19.171 17.25 19.891 17.25 20.551 17.25C14.971 11.67 9.33103 6.03 3.75103 0.45C3.15103 -0.15 2.19103 -0.15 1.65103 0.45C1.23103 0.87 0.871026 1.23 0.451026 1.65C-0.928974 2.97 1.17103 5.07 2.55103 3.75Z" fill="black"/>
</g>
<defs>
<clipPath id="clip0_1102_437">
<rect width="39" height="39" fill="white"/>
</clipPath>
</defs>
</svg></div><div class="g sl">
                            <?php $index=1; foreach($cardResult as $card) { ?>
                                <div>
                                    <img class="card-injection__r-img" 
                                     src="<?= $card['картинка']['url'] ?>"
                                     alt="<?= $card['картинка']['alt'] ?>"
                                     title="<?= $card['картинка']['title'] ?>">
                                     <div class="info">
                                        <?php foreach($card['информация'] as $i) { ?>
                                            <p><span><?php echo $i['текст_1']; ?>:</span><?php echo $i['текст_2']; ?></p>
                                        <?php } ?>
                                    </div>
                                 </div>
                            <?php $index++; } ?>
                            </div></div>
                        </div>
                    </div>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
                    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
                    <script>
                        $('.card-video_result > a').click(function(e){
                            var i=$(this).index();
                            e.preventDefault();
                            $('#modal').fadeIn(500);
                            $('.sl').not('.slick-initialized').slick({
                                slidesToShow:1,
                                fade:true,
                                arrows:true,
                                adaptiveHeight:true,
                            });
                            $('.sl').slick('slickGoTo',i);
                            $('html').addClass('open');
                        });
                        $('#modal .close, #modal .bg').click(function(e){
                            e.preventDefault();
                            $('#modal').fadeOut(500);
                            $('html').removeClass('open');
                        });
                    </script>
                <? endif; ?>
            </div>


			<? //блок  категории?>
			<? $advantages = get_field( "advantages", $id ); ?>
			<? if ( $advantages ) : ?>
                <div class="advantages mb-block">

					<? if ( get_field( "advantages_subtitle", $id ) ) : ?>
                        <div class="title-section">
                            <h2><? the_field( "advantages_subtitle", $id ); ?></h2>
                        </div>
					<? endif; ?>

                    <div class="advantages__inner">
						<? foreach ( $advantages as $key => $cat ): ?>
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



