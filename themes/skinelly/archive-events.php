<?php
	get_header();
	$id = get_post_type() . '_options';
?>


<div class="events">
    <div class="container">
        <div class="events-header">
            <div class="title-section">
                <h1>
					<?= (get_meta($id)["h1"]) ? get_meta($id)["h1"] : the_archive_title(); ?>
                </h1>
            </div>
        </div>


		<? //Ближайшие мероприятия?>
		<? $date_now = date('Y-m-d H:i:s'); ?>

		<? $args = [
			'posts_per_page' => -1,
			'post_type'      => 'events',
			'orderby'        => 'date',
			'order'          => 'asc',
			'meta_query'     => [
				[
					'key'     => 'date',
					'compare' => '>=',
					'value'   => $date_now,
					'type'    => 'DATETIME',
				],

			],
		];

			$wp_query = new WP_Query($args);
		?>

		<? if ($wp_query->have_posts()): ?>

            <h2 class="events-title-section">Ближайшие мероприятия</h2>

            <div class="events-list">
				<? while ($wp_query->have_posts()) :
					$wp_query->the_post(); ?>
                    <div class="events-item">

                        <a href="<?php the_permalink(); ?>" class="events-image">
							<? $img = get_the_post_thumbnail($post->ID, 'full'); ?>
							<? if ($img): ?>
								<? echo $img; ?>
							<? else: ?>
                                <img src="<?= get_template_directory_uri() . '/public/no-photo.png' ?>" alt="<? the_title(); ?>">
							<? endif; ?>
                        </a>
                        <div class="events-wrap-title">
                            <div class="events-date"><?= substr(get_field("date", $post->id), 0, -5); ?>
								<? if (get_field("date_end", $post->id)): ?>
                                    -<?= substr(get_field("date_end", $post->id), 0, -5); ?>
								<? endif; ?>
                            </div>
                            <div class="events-title">
								<?= (get_field('theme_title', $post->id)) ? get_field('theme_title', $post->id) : the_title(); ?>
                            </div>
							<? if (get_field("city", $post->id)): ?>
                                <div class="events-city"><?= get_field("city", $post->id); ?></div>
							<? endif; ?>
                        </div>
						<? if (get_field("theme", $post->id)): ?>
                            <div class="events-text"><?= get_field("theme", $post->id); ?></div>
						<? endif; ?>
                        <a href="<?php the_permalink(); ?>" class="button button_tr events-btn">Подробнее</a>

                    </div>
				<? endwhile; ?>

				<? wp_reset_query(); ?>
            </div>
		<? endif; ?>


		<? //Прошедшие мероприятия?>
		<?
			$args = [
				'posts_per_page' => 6,
				'post_type'      => 'events',
				'orderby'        => 'date',
				'order'          => 'desc',
				'meta_query'     => [
					[
						'key'     => 'date',
						'compare' => '<=',
						'value'   => $date_now,
						'type'    => 'DATETIME',
					],

				],
				'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
			];

			$wp_query_past = new WP_Query($args);
		?>

		<? if ($wp_query_past->have_posts()): ?>

            <h2 class="events-title-section">Прошедшие мероприятия</h2>

            <div class="events-list">
				<? while ($wp_query_past->have_posts()) :
					$wp_query_past->the_post(); ?>

                    <div class="events-item">

                        <a href="<?php the_permalink(); ?>" class="events-image">
							<? $img = get_the_post_thumbnail($post->ID, 'full'); ?>
							<? if ($img): ?>
								<? echo $img; ?>
							<? else: ?>
                                <img src="<?= get_template_directory_uri() . '/public/no-photo.png' ?>" alt="<? the_title(); ?>">
							<? endif; ?>
                        </a>
                        <div class="events-wrap-title">
                            <div class="events-date"><?= substr(get_field("date", $post->id), 0, -5); ?>
								<? if (get_field("date_end", $post->id)): ?>
                                    -<?= substr(get_field("date_end", $post->id), 0, -5); ?>
								<? endif; ?>
                            </div>
                            <div class="events-title">
								<?= (get_field('theme_title', $post->id)) ? get_field('theme_title', $post->id) : the_title(); ?>
                            </div>
							<? if (get_field("city", $post->id)): ?>
                                <div class="events-city"><?= get_field("city", $post->id); ?></div>
							<? endif; ?>
                        </div>
						<? if (get_field("theme", $post->id)): ?>
                            <div class="events-text"><?= get_field("theme", $post->id); ?></div>
						<? endif; ?>
                        <a href="<?php the_permalink(); ?>" class="button button_tr events-btn">Подробнее</a>

                    </div>

				<? endwhile; ?>
            </div>

			<? // Pagination?>
			<? if ($wp_query_past->max_num_pages > 1): ?>
				<?
				$big   = 999999999; // need an unlikely integer
				$links = paginate_links([
					'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
					'format'    => '?paged=%#%',
					'current'   => max(1, get_query_var('paged')),
					'total'     => $wp_query_past->max_num_pages,
					'prev_text' => '<',
					'next_text' => '>',
					'type'      => 'array',

				]);
				?>
				<? if (!empty($links)): ?>
                    <ul class="pagination">
						<? foreach ($links as $link): ?>
                            <li><?php echo $link; ?></li>
						<? endforeach; ?>
                    </ul>
				<? endif; ?>
			<? endif; ?>
			<? wp_reset_query(); ?>
		<? endif; ?>

    </div>


</div>


<?php get_footer(); ?>
