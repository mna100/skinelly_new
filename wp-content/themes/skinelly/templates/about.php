<?php /* Template Name: О компании */
	get_header();
	$id = get_the_ID();
?>

<div class="about">
	<? ( get_field( "about_bg", $id ) ) ? $url = get_field( "about_bg", $id ) : $url = false; ?>
    <div class="container"<?= ( $url ) ? 'style="background-image: url(\'' . $url . '\')"' : ''; ?> >
        <div class="about-header">
            <div class="title-section title-section_about">
                <h1><?= get_meta( $id )["h1"]; ?></h1>
            </div>
        </div>

		<? //блок с картинками слева?>
		<? $prop = get_field( "about-prop", $id ); ?>
		<? if ( $prop ) : ?>
            <div class="about-prop mb-block">
				<? foreach ( $prop as $cat ): ?>
                    <div class="about-prop__card">
                        <img data-src="<?= $cat["img"]['url']; ?>" class="lozad about-prop__img" alt="<?= $cat["img"]['alt']; ?>" title="<?= $cat["img"]['alt']; ?>">
                        <div class="about-prop__text"><?= $cat["text"]; ?></div>
                    </div>
				<? endforeach; ?>
            </div>
		<? endif; ?>


        <div class="about-content editor mb-block">
			<? the_field( "content", $id ); ?>
        </div>

		<? //блок технология производства?>
        <div class="about-tech mb-block">
			<? if ( get_field( "about-tech__title", $id ) ) : ?>
                <div class="title-section">
                    <h2><? the_field( "about-tech__title", $id ); ?></h2>
                </div>
			<? endif; ?>
			<? if ( get_field( "about-tech__img", $id ) ): ?>
                <div class="about-tech__inner">
                    <picture>
                        <source srcset="<?= get_field( "about-tech__img-mobile", $id )['url']; ?>" media="(max-width: 600px)">
                        <img data-fancybox data-src="<?= get_field( "about-tech__img", $id )['url']; ?>" class="lozad about-tech__img" alt="<?= $cat["about-tech__img"]['alt']; ?>" title="<?= $cat["about-tech__img"]['alt']; ?>">
                    </picture>
                </div>
			<? endif; ?>
        </div>

		<? //блок сертификаты?>
		<? $sert = get_field( "about-sert", $id ); ?>
		<? if ( $sert ) : ?>
            <div class="about-sert mb-block" id="sertificate">
				<? if ( get_field( "about-sert__title", $id ) ) : ?>
                    <div class="title-section">
                        <h2><? the_field( "about-sert__title", $id ); ?></h2>
                    </div>
				<? endif; ?>
                <div class="about-sert__inner">
					<? foreach ( $sert as $cat ): ?>
                        <div class="about-sert__card">
                            <img data-fancybox="gallary" data-src="<?= $cat["img"]['url']; ?>" class="lozad about-psert__img" alt="<?= $cat["img"]['alt']; ?>" title="<?= $cat["mg"]['alt']; ?>">
                        </div>
					<? endforeach; ?>
                </div>
            </div>
		<? endif; ?>


    </div>
</div>

<?php get_footer(); ?>
