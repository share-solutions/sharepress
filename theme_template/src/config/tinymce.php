<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:26
 */

return [
	'buttons' => [
		// https://madebydenis.com/adding-shortcode-button-to-tinymce-editor/
		// https://wordpress.stackexchange.com/questions/235020/how-to-add-insert-edit-link-button-in-custom-popup-tinymce-window
		//
		// https://www.tinymce.com/docs/api/tinymce.ui/tinymce.ui.button/ and https://www.tinymce.com/docs/api/tinymce/tinymce.plugin/
		// and most of the ui related entries
		/*
		 *
		 * You may also register buttons returning a configuration array
		 * from your Shortcode Class tinymceButton method
		 *
		 */
		'splitter' => [
			'post_type' => ['post', 'people'],
			'label' => 'Splitter',
			'windowLabel' => 'Splitter',
			'shortcode' => 'splitter',
		],
	],
	'editor_styles' => [
		/*
		 * If you're using this, don't forget to add the css file entry to app.resources.editor
		 *
		 *
		 * https://www.tinymce.com/docs/configure/content-formatting/#formatparameters
		 *
		* Each array child is a format with it's own settings
		* Notice that each array has title, block, classes, and wrapper arguments
		* Title is the label which will be visible in Formats menu
		* Block defines whether it is a span, div, selector, or inline style
		* Classes allows you to define CSS classes
		* Wrapper whether or not to add a new block-level element around any selected elements
		*/
		[
			'title' => 'Content Header',
			'block' => 'h3',
			'classes' => 'art001-body__text-title playfair playfair--e9',
			'wrapper' => false,
		],
		/*
		[
			'title' => 'Grand Highlight',
			'block' => 'h2',
			'classes' => 'cpt008 cpt008--purple karla karla--e5',
			'wrapper' => false,
		],
		*/
		[
			'title' => 'Pointed Link',
			'block' => 'div',
			'classes' => 'cpt009 cpt009-row cpt009--pointed-link karla karla--6',
			'wrapper' => true,
		],
		[
			'title' => 'Form Titles',
			'block' => 'h4',
			'classes' => 'karla karla--e6',
			'wrapper' => false,
		]
	]
];