<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 20/02/2018
 * Time: 22:51
 */

namespace prevenir\Business\Models\Posts;


use share\SharePress\Database\Support\BaseModel;

class Page extends BaseModel
{
	use PostTransversalAccessors;

	protected $postType = "page";

	protected $customFields = [];
}