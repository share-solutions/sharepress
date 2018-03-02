<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 21/02/2018
 * Time: 23:59
 */

namespace prevenir\Business\Repos\Posts;

use prevenir\Business\Models\Posts\People;

final class PeopleRepo
{
	public static function getByRole ($roleId, $postPerPage) {
		$peopleByRole = People::set('tax_query', [[
				'taxonomy' => 'roles',
				'field' => 'id',
				'terms' => [
					$roleId
				],
				'operator' => 'IN'
			]])
			->set('posts_per_page', $postPerPage)
			->load();
		return $peopleByRole;
	}
}