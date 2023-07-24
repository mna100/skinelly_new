<?php /* Template Name: Мероприятия общая */
	get_header();
	$id = get_the_ID();
?>


<div class="events">
    <div class="container">
        <div class="events-header">
            <div class="title-section">
                <h1><?= get_meta($id)["h1"]; ?></h1>
            </div>
        </div>

        <div class="events-list">


			<?php

				$args = [
					'numberposts' => 3,
					'post_type'   => 'events',
					'orderby'     => 'date',
					'order'       => 'DESC',

				];

				$temp     = $wp_query;
				$wp_query = null;
				$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()):?>
					<? while ($wp_query->have_posts()) :
						$wp_query->the_post(); ?>

                        <div class="events-item">

                            <div class="events-image">
								<? the_post_thumbnail('full'); ?>
                            </div>

                            <div class="events-info">
                                <div class="events-date"><?php the_date(); ?></div>
                                <div class="events-title"><? the_title(); ?></div>
                                <div class="events-text">
									<? the_excerpt(); ?>>
                                </div>
                                <div class="events-btn">
                                    <a href="<?php the_permalink(); ?>">Читать больше
                                        <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 13.5L7.5 7L1 0.5" stroke="#343434"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>

					<? endwhile; ?>
					<?// Pagination
					?>
					<? if ($wp_query->max_num_pages > 1): ?>
						<?php
						$big   = 999999999; // need an unlikely integer
						$links = paginate_links([
							'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
							'format'    => '?paged=%#%',
							'current'   => max(1, get_query_var('paged')),
							'total'     => $wp_query->max_num_pages,
							'prev_text' => '<',
							'next_text' => '>',
							'type'      => 'array',

						]);
						if (!empty($links)):?>
                            <ul class="pagination">
								<? foreach ($links as $link): ?>
                                    <li><?php echo $link; ?></li>
								<? endforeach; ?>
                            </ul>
						<? endif; ?>
					<? endif; ?>
					<? wp_reset_postdata();
				else :
					echo 'Нет мероприятий';
				endif;
			?>


        </div>

    </div>


</div>


<?php get_footer(); ?>
