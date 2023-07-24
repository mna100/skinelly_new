<?php /* Template Name: Новости */
get_header();
$id = get_the_ID();
?>


<div class="news">
  <div class="container">
    <div class="news-header">
      <div class="title-section">
        <h1><?= get_meta($id)["h1"]; ?></h1>
        <p>Читайте последние новости о Skinelly</p>
      </div>
    </div>

    <div class="news-list">


      <?php

      $args = array(
        'numberposts' => 9,
        'post_type' => 'news',
        'orderby'     => 'date',
        'order'    => 'DESC',

      );

      $the_query = new WP_Query($args);
      if ($the_query->have_posts()) :
        while ($the_query->have_posts()) :
          $the_query->the_post(); ?>

          <div class="news-item">

            <div class="news-image">
              <? the_post_thumbnail('full'); ?>
            </div>

            <div class="news-info">
              <div class="news-date"><?php the_date(); ?></div>
              <div class="news-title"><? the_title(); ?></div>
              <div class="news-text">
                <? the_excerpt(); ?>>
              </div>
              <div class="news-btn">
                <a href="<?php the_permalink(); ?>">Читать больше
                  <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 13.5L7.5 7L1 0.5" stroke="#343434" />
                  </svg>
                </a>
              </div>
            </div>

          </div>

      <? endwhile;
        wp_reset_postdata();
      else :
      endif;

      ?>


    </div>

  </div>




</div>


<?php get_footer(); ?>
