<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 20/02/2018
 * Time: 22:51
 */

namespace prevenir\Business\Models\Posts;


use share\SharePress\Database\Support\BaseModel;

class People extends BaseModel
{
	protected $queryType = "post";

	protected $postType = "people";

	protected $customFields = [
		'thumbnail',
		'titulo',
		'descritivo'
	];

	public function getAttrPermalink () {
		return get_the_permalink($this->ID);
	}

	public function getAttrRoles () {
		$roles = get_the_terms($this->ID, 'roles');
		$ret = array_map(function (\WP_Term $role) {
			return new RolesTag($role);
		}, $roles);
		return $ret;
	}
}