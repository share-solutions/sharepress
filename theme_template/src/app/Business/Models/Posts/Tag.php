<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 20/02/2018
 * Time: 22:51
 */

namespace prevenir\Business\Models\Posts;


use share\SharePress\Database\Support\BaseModel;

class Tag extends BaseModel
{
	protected $queryType = "term";

	public function getAttrPermalink () {
		return get_term_link($this->term_id);
	}
}