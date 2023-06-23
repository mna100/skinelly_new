<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_63e161bd7809a',
	'title' => 'Политика обработки персональных данных',
	'fields' => array(
		array(
			'key' => 'field_63e161e2ad1fe',
			'label' => 'Текст',
			'name' => 'policy_text',
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
			'toolbar' => 'full',
			'media_upload' => 1,
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
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'templates/policy.php',
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
	'acfe_meta' => '',
	'acfe_note' => '',
	'modified' => 1681395698,
));

endif;