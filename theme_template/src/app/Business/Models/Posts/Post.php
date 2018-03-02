<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 20/02/2018
 * Time: 22:51
 */

namespace prevenir\Business\Models\Posts;


use share\SharePress\Database\Support\BaseModel;

class Post extends BaseModel
{
	use PostTransversalAccessors;

	protected $postType = "post";

	protected $customFields = [
		'tempo_leitura',
		'is_sponsored',
		'sponsor_image',
		'sponsor_name',
		'ultima_revisao',
	];
}