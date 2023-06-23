<?php /* Template Name: Каталог товаров */
get_header();
$id = get_the_ID();
$parent_id = wp_get_post_parent_id(get_the_ID());
?>
<div class="catalog">

	<div class="catalog__title">
		<div class="container">
			<? if (get_field("seo_meta_page_h1", $id)) : ?>
				<h1><? the_field("seo_meta_page_h1", $id); ?></h1>
			<? endif; ?>
		</div>
	</div>


	<div class="catalog__tab">
		<a class="catalog__tab-link <? if ($parent_id == 32) : ?>catalog__tab-link--current<? endif; ?>" href="/jesteticheskaja-medicina">Эстетическая медицина</a>
		<a class="catalog__tab-link <? if ($parent_id == 34) : ?>catalog__tab-link--current<? endif; ?>" href="/intimnaja-plastika">Интимная пластика</a>
	</div>


	<div class="catalog__main">

		<div class="container-small">

			<?
			$query = new WP_Query([
				"post_type"   => "page",
				"post_parent" => $id,
				"order"       => "ASC",
				"orderby"     => "menu_order"
			]);
			$pages = $query->posts;

			$catalog_pages = [];
			foreach ($pages as $page) {
				$catalog_pages[] = [
					'id'    => $page->ID,
					'title' => $page->post_title,
					'link'  => get_page_link($page->ID),
					'image' => get_the_post_thumbnail_url($page->ID, 'medium'),
					'color' => get_field("product_color", $page->ID),
				];
			}

			?>

			<div class="catalog__products">
				<? foreach ($catalog_pages as $category) : ?>

					<a href="<?= $category["link"]; ?>" class="catalog__product" style="--product-color: <?= $category["color"]; ?>">
						<img src="<?= $category["image"]; ?>" alt="">
						<span class="catalog__product-name">
							<?= $category["title"]; ?>
						</span>
					</a>

				<? endforeach; ?>
			</div>

		</div>

	</div>


	<div class="catalog__additional__text container-small">
		<?php echo get_field('catalog__additional__text', $page_id); ?>
	</div>
	
</div>



<?php get_footer(); ?>