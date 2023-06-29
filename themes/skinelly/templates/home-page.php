<?php /* Template Name: Главная */
	get_header();
	$id         = get_the_ID();
	$advantages = get_field( "home_advantages_list", $id );
	$categories = get_field( "home_categories", $id );
	$pallet     = get_field( "home_palette", $id );
	$group      = get_field( "home_group", $id );
	$prop       = get_field( "home_properties", $id );
?>
    <div class="home">
		<? //блок баннер?>
        <div class="home-banner mb-block">

            <div class="home-banner__title">
                <div class="container">
                    <h1 class="main-h1"><? the_field( "seo_meta_page_h1", $id ); ?></h1>
                </div>
            </div>

            <div class="home-banner__image">
                <a href="drug/skinelly-light/">
                    <picture>
                        <source media="(max-width: 767px)" srcset="<? the_field( "home_banner_img_mobile", $id ); ?>">
                        <img class="lozad" data-src="<? the_field( "home_banner_img", $id ); ?>" alt="skinelly">
                    </picture>
                </a>
            </div>
        </div>

		<? //блок палитра?>
		<? if ( ! get_field( "home_pallete_visible", $id ) ) : ?>
            <div class="home-pallet mb-block">
                <div class="container">
					<? if ( get_field( "home_pallete_title", $id ) ) : ?>
                        <div class="title-section">
                            <h2><? the_field( "home_pallete_title", $id ); ?></h2>
                        </div>
					<? endif; ?>

					<? if ( $pallet ) : ?>
                        <div class="home-pallet__inner">
							<? foreach ( $pallet as $cat ): ?>
                                <div class="home-pallet__card">
                                    <img data-src="<?= $cat["img"]['url']; ?>" class="lozad home-pallet__img" alt="<?= $cat["img"]['alt']; ?>" title="<?= $cat["img"]['alt']; ?>">
                                    <span class="home-pallet__title"><?= $cat["name"]; ?></span>
                                    <div class="home-pallet__hover">
                                        <img data-src="<?= $cat["img"]['url']; ?>" class="lozad home-pallet__img" alt="<?= $cat["img"]['alt']; ?>" title="<?= $cat["img"]['alt']; ?>">
                                        <span class="home-pallet__title"><?= $cat["name"]; ?></span>
                                        <span class="home-pallet__text"><?= $cat["text"]; ?></span>
                                        <a href="<?= $cat["link"]; ?>" class="home-pallet__link button button_tr">Подробнее</a>
                                    </div>
                                </div>
							<? endforeach; ?>
                        </div>
					<? endif; ?>
                </div>
            </div>
		<? endif; ?>

		<? //блок группы препаратов?>
		<? if ( ! get_field( "home_group_visible", $id ) ) : ?>
            <div class="home-group mb-block">
                <div class="container">
					<? if ( get_field( "home_group_title", $id ) ) : ?>
                        <div class="title-section">
                            <h2><? the_field( "home_group_title", $id ); ?></h2>
                        </div>
					<? endif; ?>

					<? if ( $group ) : ?>
                        <div class="home-group__inner">
							<? foreach ( $group as $cat ): ?>
                                <div class="home-group__card">
                                    <img data-src="<?= $cat["img"]['url']; ?>" class="lozad home-group__img" alt="<?= $cat["img"]['alt']; ?>" title="<?= $cat["img"]['alt']; ?>">
                                    <span class="home-group__title"><?= $cat["name"]; ?></span>
                                    <span class="home-group__text"><?= $cat["text"]; ?></span>
                                </div>
							<? endforeach; ?>
                        </div>
					<? endif; ?>
                </div>
            </div>
		<? endif; ?>

		<? //блок принципиальные особенности?>
		<? if ( ! get_field( "home_prop_visible", $id ) ) : ?>
            <div class="home-prop mb-block">
                <div class="container">
					<? if ( get_field( "home_prop_title", $id ) ) : ?>
                        <div class="title-section">
                            <h2><? the_field( "home_prop_title", $id ); ?></h2>
                        </div>
					<? endif; ?>

					<? if ( $prop ) : ?>
                        <div class="home-prop__inner">
							<? foreach ( $prop as $cat ): ?>
                                <div class="home-prop__card">
                                    <img data-src="<?= $cat["img"]['url']; ?>" class="lozad home-prop__img" alt="<?= $cat["img"]['alt']; ?>" title="<?= $cat["img"]['alt']; ?>">
                                    <div class="home-prop__content">
                                        <div class="home-prop__title"><?= $cat["name"]; ?></div>
                                        <div class="home-prop__text"><?= $cat["text"]; ?></div>
                                    </div>

                                </div>
							<? endforeach; ?>
                        </div>
					<? endif; ?>
                </div>
            </div>
		<? endif; ?>


		<? //блок о скинелли?>
		<? if ( ! get_field( "home_about_visible", $id ) ) : ?>
            <div class="home-about mb-block">
                <div class="container">
					<? if ( get_field( "home_about_title", $id ) ) : ?>
                        <div class="title-section">
                            <h2><? the_field( "home_about_title", $id ); ?></h2>
                        </div>
					<? endif; ?>

                    <div class="home-about__main">
						<? the_field( "home_about_text", $id ); ?>
                    </div>

                    <div class="home-about__row">

						<? $home_about_pictures = get_field( "home_about_images", $id ); ?>

						<? if ( $home_about_pictures ) : ?>
                            <div class="home-about__pictures">
								<? foreach ( $home_about_pictures as $picture ) : ?>
                                    <img class="lozad" data-src="<?= $picture["image"]; ?>" alt="">
								<? endforeach; ?>
                            </div>
						<? endif; ?>

						<? $home_about_list = get_field( "home_about_list", $id ); ?>
						<? if ( $home_about_list ) : ?>
                            <div class="home-about__list">
								<? foreach ( $home_about_list as $el ) : ?>
                                    <div class="home-about__list-item">
                                        <div class="home-about__list-subtitle"><?= $el["title"]; ?></div>
                                        <div class="home-about__list-text"><?= $el["text"]; ?></div>
                                    </div>
								<? endforeach; ?>
                            </div>
						<? endif; ?>

                    </div>

                </div>

            </div>
		<? endif; ?>

		<? //блок о преимущества?>
		<? if ( ! get_field( "home_advantages_visible", $id ) ) : ?>
            <div class="home-advantages mb-block">

                <div class="container">

					<? if ( get_field( "home_advantages_title", $id ) ) : ?>
                        <div class="title-section">
                            <h2><? the_field( "home_advantages_title", $id ); ?></h2>
                        </div>
					<? endif; ?>

                    <div class="home-advantages__main">
						<? if ( get_field( "home_advantages_image" ) ) : ?>
                            <div class="home-advantages__picture">
                                <img class="lozad" data-src="<? the_field( "home_advantages_image", $id ); ?>" alt="">
                            </div>
						<? endif; ?>

						<? if ( $advantages ) : ?>
                            <div class="home-advantages__list">

								<? foreach ( $advantages as $key => $advantage ) : ?>
									<? $key ++; ?>
                                    <div class="home-advantages__item home-advantages__item-<?= $key; ?>">
                                        <div class="home-advantages__item-number"><?= $key; ?></div>
                                        <div class="home-advantages__item-title"><?= $advantage["text"]; ?></div>
                                    </div>

								<? endforeach; ?>
                            </div>
						<? endif; ?>
                    </div>

                </div>

            </div>
		<? endif; ?>

		<? //блок  категории?>
		<? if ( ! get_field( "home_category_visible", $id ) ) : ?>
            <div class="home-category mb-block">

                <div class="container">

					<? if ( get_field( "home_category_title", $id ) ) : ?>
                        <div class="title-section">
                            <h2><? the_field( "home_category_title", $id ); ?></h2>
                        </div>
					<? endif; ?>

					<? if ( $categories ) : ?>
                        <div class="home-category__row">
							<? foreach ( $categories as $cat ) { ?>

                                <div class="home-category__card">
                                    <img data-src="<?= $cat["image"]; ?>" class="lozad home-category__img" alt="<?= $cat["name"]; ?>" title="<?= $cat["name"]; ?>">
                                    <a href="<?= $cat["link"]; ?>" class="home-category__link button button_tr"><?= $cat["name"]; ?></a>
                                </div>

							<? } ?>
                        </div>
					<? endif; ?>
                </div>


            </div>
		<? endif; ?>

		<? //блок  form?>
		<?php if ( ! get_field( "form_visible", $id ) ) {
			include_once TEMPLATEPATH . '/templates/form.php';
		}
		?>
    </div>
<?php get_footer(); ?>