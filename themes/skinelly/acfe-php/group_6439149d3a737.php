<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_6439149d3a737',
	'title' => 'Изображение типов препаратов',
	'fields' => array(
		array(
			'key' => 'field_64392787e2e68',
			'label' => 'Изображение',
			'name' => 'drug_type_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'uploader' => '',
			'acfe_thumbnail' => 0,
			'return_format' => 'array',
			'preview_size' => 'full',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
			'acfe_field_group_condition' => 0,
			'library' => 'all',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'taxonomy_term_type',
				'operator' => '==',
				'value' => 'child',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'left',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'acfe_autosync' => array(
		0 => 'php',
		1 => 'json',
	),
	'acfe_form' => 0,
	'acfe_display_title' => '',
	'acfe_meta' => array(
		'acfcloneindex' => array(
			'acfe_meta_key' => '',
			'acfe_meta_value' => '',
		),
	),
	'acfe_note' => '',
	'modified' => 1681467348,
));

endif;