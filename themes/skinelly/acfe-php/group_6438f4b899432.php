<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_6438f4b899432',
	'title' => 'Текстовое описание типов препаратов',
	'fields' => array(
		array(
			'key' => 'field_6438f4bf3deea',
			'label' => 'Текстовое описание',
			'name' => 'drug_type_text_descr',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'basic_enhanced',
			'media_upload' => 0,
			'delay' => 0,
			'acfe_wysiwyg_height' => 300,
			'acfe_wysiwyg_max_height' => '',
			'acfe_wysiwyg_valid_elements' => '',
			'acfe_wysiwyg_custom_style' => '',
			'acfe_wysiwyg_disable_wp_style' => 0,
			'acfe_wysiwyg_autoresize' => 0,
			'acfe_wysiwyg_disable_resize' => 0,
			'acfe_wysiwyg_remove_path' => 0,
			'acfe_wysiwyg_menubar' => 0,
			'acfe_wysiwyg_transparent' => 0,
			'acfe_wysiwyg_merge_toolbar' => 0,
			'acfe_wysiwyg_custom_toolbar' => 0,
			'acfe_field_group_condition' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'drug-types',
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
	'modified' => 1687158280,
));

endif;