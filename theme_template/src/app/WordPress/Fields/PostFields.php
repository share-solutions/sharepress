<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 31/01/2018
 * Time: 15:49
 */

namespace prevenir\WordPress\Fields;

use share\SharePress\Configuration\IRegister;
use share\SharePress\Configuration\Register;
use share\SharePress\WordPress\ACFFieldsRegistry;

class PostFields extends Register implements IRegister
{
	use ACFFieldsRegistry;

	public function __construct()
	{
		$this->setACFRegisterMethod();
		parent::__construct();
	}

	public function register()
	{
		/*
		if (function_exists($this->acfRegisterMethod)) {
			($this->acfRegisterMethod)(
				array(
					'key' => 'group_5a85752909961',
					'title' => 'Posts Fields',
					'fields' => array(
						array(
							'key' => 'field_5a8575401af40',
							'label' => 'É Patrocinado?',
							'name' => 'is_sponsored',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => 0,
							'message' => '',
							'ui' => 0,
							'ui_on_text' => '',
							'ui_off_text' => '',
						),
						array(
							'key' => 'field_5a85770cf536f',
							'label' => 'Imagem do Patrocinador',
							'name' => 'sponsor_image',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_5a8575401af40',
										'operator' => '==',
										'value' => '1',
									),
								),
							),
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'preview_size' => 'thumbnail',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array(
							'key' => 'field_5a857733f5370',
							'label' => 'Nome do Patrocinador',
							'name' => 'sponsor_name',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_5a8575401af40',
										'operator' => '==',
										'value' => '1',
									),
								),
							),
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
						),
					),
					'location' => array(
						array(
							array(
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'post',
							),
						),
					),
					'menu_order' => 0,
					'position' => 'normal',
					'style' => 'default',
					'label_placement' => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen' => '',
					'active' => 1,
					'description' => '',
				));
		}
		*/
	}
}