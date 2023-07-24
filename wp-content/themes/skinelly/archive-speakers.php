<?php
	get_header();
	$id = get_post_type() . '_options';
?>


<div class="news news_speakers">
    <div class="container">
        <div class="title-section">
            <h1>
				<?= ( get_meta( $id )["h1"] ) ? get_meta( $id )["h1"] : the_archive_title(); ?>
            </h1>
        </div>


		<?php

			$args     = [
				//'showposts' => 3,
				'posts_per_page' => 9,
				'post_type'      => 'speakers
				
				',
				'orderby'        => 'date',
				'order'          => 'ASC',
				'paged'          => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,

			];
			$wp_query = new WP_Query( $args );

			if ( $wp_query->have_posts() ):?>
                <div class="news-list mb-block">
					<? while ( $wp_query->have_posts() ) :
						$wp_query->the_post();
						?>

                        <div class="news-item">

                            <a href="<?php the_permalink(); ?>" class="news-image mb-block">
								<? $img = get_the_post_thumbnail( $post->ID, 'full' ); ?>
								<? if ( $img ): ?>
									<? echo $img; ?>
								<? else: ?>
                                    <img src="<?= get_template_directory_uri() . '/public/no-photo.png' ?>" alt="<? the_title(); ?>">
								<? endif; ?>
                            </a>
                            <div class="news-info">
                                <div class="news-title"><?= ( get_meta( $id )["title"] ) ? get_meta( $id )["title"]
										: the_title(); ?></div>
								<? if ( get_field( "spicker_text_all", $id ) ): ?>
                                    <div class="news-text"><? the_field( "spicker_text_all", $id ); ?></div>
								<? endif; ?>
                                <a href="<?php the_permalink(); ?>" class="button button_tr news-btn">Подробнее</a>
                            </div>

                        </div>

					<? endwhile; ?>


                </div>
				<?// Pagination
				?>
				<? if ( $wp_query->max_num_pages > 1 ): ?>
					<?php

					$big   = 999999999; // need an unlikely integer
					$links = paginate_links( [
						'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'    => '?paged=%#%',
						'current'   => max( 1, get_query_var( 'paged' ) ),
						'total'     => $wp_query->max_num_pages,
						'prev_text' => '<svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 1L1 7.5L7 14" stroke="black"/>
                                            </svg>',
						'next_text' => '<svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 1L7 7.5L1 14" stroke="black"/>
                                            </svg>',
						'type'      => 'array',

					] );
					if ( ! empty( $links ) ):?>
                        <ul class="pagination">
							<? foreach ( $links as $link ): ?>
                                <li><?php echo $link; ?></li>
							<? endforeach; ?>
                        </ul>
					<? endif; ?>
				<? endif; ?>
				<? wp_reset_postdata(); ?>
			<?
			else :
				echo 'Нет новостей';
			endif;
		?>


    </div>


</div>

<?php get_footer(); ?>

