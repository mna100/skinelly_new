<?php get_header(); ?>
<?
/*
	 * Страница типа катлог выводит типы препаратов
	 * */

?>
<div class="catalog">

	<div class="container">
		<div class="title-section">
			<h1><?= get_meta(get_queried_object()->term_id)["h1"]; ?></h1>
		</div>
	</div>


	<? //подрубрики
	?>
	<?
	if (get_queried_object()->slug !== 'cosmetology' && get_queried_object()->slug !== 'gynecology') :
		$drug_type = new WP_Query([
			'posts_per_page' => -1,
			'post_type'      => "drug",
			'post_status'    => 'publish',
			'tax_query'      => [
				[
					'taxonomy' => 'drug-types',
					'field'    => 'term_id',
					'terms'    => get_queried_object()->term_id,
				],
			],
		]);

		if ($drug_type->have_posts()) :
	?>
			<div class="catalog__products mb-block">
				<div class="container">
					<div class="catalog__products-wrapper">
						<?
						while ($drug_type->have_posts()) :
							$drug_type->the_post();
						?>

							<a href="<?= get_permalink(); ?>" class="catalog__product">
								<img class="lozad" data-src="<?= get_the_post_thumbnail_url(get_the_ID(), 'large') ?>" alt="<?= get_field("seo_meta_page_h1", get_the_ID()); ?>">
								<span class="button button_white">
									<?= get_field("seo_meta_page_h1", get_the_ID()); ?>
								</span>
							</a>

						<?
						endwhile;
						wp_reset_query();
						?>
					</div>
				</div>
			</div>
	<?
		endif;
	endif;
	?>

	<? //характеристики
	?>
	<? if (get_field("drug_type_prop", "drug-types_" . get_queried_object()->term_id)) : ?>
		<div class="container">
			<div class="catalog__prop">
				<? foreach (get_field("drug_type_prop", "drug-types_" . get_queried_object()->term_id) as $tag_tile) : ?>
					<div class="catalog__prop-item catalog__prop-item-main">
						<? if ($tag_tile["title"]) : ?>
							<div class="catalog__prop-title"><?= $tag_tile["title"] ?></div>
						<? endif; ?>
						<? if ($tag_tile["text"]) : ?>
							<div class="catalog__prop-text editor"><?= $tag_tile["text"] ?></div>
						<? endif; ?>
					</div>
				<? endforeach; ?>
			</div>
		</div>
	<? endif; ?>

	<? ////верхняя рубрика
	?>
	<?
	$top_term_children = [];
	$term_children_ids = get_term_children(get_queried_object()->term_id, "drug-types");
	foreach ($term_children_ids as $child_id) {
		if (get_term($child_id)->parent === get_queried_object()->term_id) {
			$top_term_children[] = get_term($child_id);
		}
	}
	if (count($top_term_children) > 0) :
	?>
		<div class="catalog__categories mb-block">
			<div class="container">
				<div class="catalog__categories-wrapper">
					<? foreach ($top_term_children as $child) : ?>
						<a href="<?= get_term_link($child->term_id); ?>" class="catalog__category">
							<? if (get_field("drug_type_image", "drug-types_" . $child->term_id)) : ?>
								<img class="lozad" data-src="<?= get_field("drug_type_image", "drug-types_" . $child->term_id)["url"]; ?>" alt="<?= get_field("drug_type_image", "drug-types_" . $child->term_id)["alt"]; ?>">
							<? endif; ?>
							<span class="button button_white">
								<?= get_meta($child->term_id)["h1"] ?>
							</span>
						</a>
					<? endforeach; ?>
				</div>
			</div>
		</div>
	<? endif; ?>

	<? //остальное описание и тд на данный момент отсутсвует
	?>
	<? if (get_field("drug_type_text_descr", "drug-types_" . get_queried_object()->term_id)) : ?>
		<div class="catalog__text-descr mb-block">
			<div class="container catalog__text-descr-wrapper">
				<?= get_field("drug_type_text_descr", "drug-types_" . get_queried_object()->term_id); ?>
			</div>
		</div>
	<? endif; ?>

	<? if (get_field("tag_tiles", "drug-types_" . get_queried_object()->term_id)) : ?>
		<div class="catalog__tag-tiles mb-block">
			<div class="container-small">
				<ul class="catalog__tag-tiles-wrapper">
					<? foreach (get_field("tag_tiles", "drug-types_" . get_queried_object()->term_id) as $tag_tile) : ?>

						<li class="catalog__tag-tile">
							<? if ($tag_tile["type"] === "modal") : ?>
								<button class="catalog__tag-tile-entity catalog__tag-tile-entity--type--button modal-link" data-href="#popup" type="button">
									<?= $tag_tile["label"] ?>
								</button>
							<? elseif ($tag_tile["type"] === "link") : ?>
								<a class="catalog__tag-tile-entity catalog__tag-tile-entity--type--link" href="<?= $tag_tile["page_link"] ?>">
									<?= $tag_tile["label"] ?>
								</a>
							<? endif; ?>
						</li>

					<? endforeach; ?>
				</ul>
			</div>
		</div>
	<? endif; ?>
</div>

<?php get_footer(); ?>
