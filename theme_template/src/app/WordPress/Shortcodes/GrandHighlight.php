<?php
/**
 * Created by PhpStorm.
 * User: Ângelo Marques
 * Date: 16/12/2016
 * Time: 15:18
 */

namespace prevenir\WordPress\Shortcodes;

use prevenir\Business\Models\Posts\Post;
use share\SharePress\WordPress\Shortcodes\Shortcode;

class GrandHighlight extends Shortcode
{
	public $tag = "grand_highlight";

	public function run($tag, $atts, $content = null)
	{
		$post = new Post(get_post());
		return view('shortcodes.grand_highlight', ['post' => $post, 'content' => $content]);
	}

	public function tinymceButton () {
		return [
			'post_type' => ['post'],
			'label' => 'Grand Highlight',
			'windowLabel' => 'Grand Highlight',
			'shortcode' => 'grand_highlight',
			'fields' => [
				[
					'type' => 'textbox',
					'name' => 'content',
					'label' => 'Conteúdo',
					//'tooltip' => 'Some nice tooltip to use',
					//'value' => '',
					'multiline' => true,
					'autofocus' => true,
					'minHeight' => 200,
					'minWidth' => 400
				],
				[
					'type' => 'listbox',
					'name' => 'posts',
					'label' => 'Posts',
					'values' => array_map(function ($item) { return ['text' => $item->post_title, 'value' => $item->ID]; }, Post::load()),
				]
				/*
				 * https://wordpress.stackexchange.com/questions/235020/how-to-add-insert-edit-link-button-in-custom-popup-tinymce-window
				 *
				 * {
                                        type: 'button',
                                        name: 'link',
                                        text: 'Insert/Edit link',
                                        onclick: function( e ) {
                                            //get the Wordpess' "Insert/edit link" popup window.
                                            var textareaId = jQuery('.mce-custom-textarea').attr('id');
                                            //wpActiveEditor = true; //we need to override this var as the link dialogue is expecting an actual wp_editor instance
                                            wpLink.open( textareaId ); //open the link popup
                                            return false;
                                        },
                                    }
				 */
			],
		];
	}
}