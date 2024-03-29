<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_643931491cdb2',
	'title' => 'Плитка тегов',
	'fields' => array(
		array(
			'key' => 'field_643931d3c0a57',
			'label' => 'Плитка тегов',
			'name' => 'tag_tiles',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'acfe_repeater_stylised_button' => 1,
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'block',
			'button_label' => '',
			'acfe_field_group_condition' => 0,
			'sub_fields' => array(
				array(
					'key' => 'field_64393210c0a59',
					'label' => 'Плитка',
					'name' => '',
					'type' => 'accordion',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'open' => 0,
					'multi_expand' => 0,
					'endpoint' => 0,
					'acfe_field_group_condition' => 0,
				),
				array(
					'key' => 'field_6439321dc0a5a',
					'label' => 'Лейбл плитки',
					'name' => 'label',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'acfe_field_group_condition' => 0,
				),
				array(
					'key' => 'field_64393226c0a5b',
					'label' => 'Тип плитки',
					'name' => 'type',
					'type' => 'button_group',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'modal' => 'Модальное окно',
						'link' => 'Ссылка',
					),
					'allow_null' => 0,
					'default_value' => '',
					'layout' => 'horizontal',
					'return_format' => 'value',
					'acfe_field_group_condition' => 0,
				),
				array(
					'key' => 'field_64393247c0a5c',
					'label' => 'Ссылка на страницу',
					'name' => 'page_link',
					'type' => 'page_link',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_64393226c0a5b',
								'operator' => '==',
								'value' => 'link',
							),
						),
					),
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => '',
					'taxonomy' => '',
					'allow_null' => 0,
					'allow_archives' => 1,
					'multiple' => 0,
					'acfe_field_group_condition' => 0,
				),
			),
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
	'modified' => 1698178046,
));

endif;