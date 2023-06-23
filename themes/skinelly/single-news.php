<?php
	/**
	 * Template Name: Шаблон новости
	 * Template Post Typ*/

	get_header();
	$id = get_the_ID();

?>

<div class="news news-post">
    <div class="container">
        <div class="news-header">
            <div class="title-section">
                <h1><?= (get_meta($id)["h1"]) ? get_meta($id)["h1"] : $post->post_title; ?></h1>
            </div>
        </div>

		<? $banner = get_field("banner", $id); ?>

		<? if ($banner) : ?>
            <div class="news-banner">
                <img src="<?= $banner; ?>" alt="">
            </div>
		<? endif; ?>

        <div class="news-content">
			<? the_content(); ?>
        </div>

		<? if (get_field("youtube-videos", get_the_ID())) : ?>
            <ul class="news-youtube-videos">
				<? foreach (get_field("youtube-videos", get_the_ID()) as $video) : ?>
                    <li class="news-youtube-video">
                        <iframe width="500" height="280" src="<?= $video["link"]; ?>" title="<?= $video["title"]; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </li>
				<? endforeach; ?>
            </ul>
		<? endif; ?>

    </div>
</div>


<?php get_footer(); ?>
