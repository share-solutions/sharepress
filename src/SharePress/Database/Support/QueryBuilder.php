<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 20/02/2018
 * Time: 22:50
 */

namespace share\SharePress\Database\Support;


final class QueryBuilder
{
	private $queryType;
	private $query;
	private $queryArgs = [];
	private $model;

	public function __construct($queryType = 'post', $model)
	{
		$this->queryType = $queryType;
		$this->model     = $model;
		$this->query     = $this->queryType === 'post' ? new \WP_Query() : new \WP_Term_Query();
	}

	public function find ($id, $taxonomy = '') {
		if($this->queryType === "post") {
			return new $this->model(get_post($id));
		} else if ($this->queryType == "term") {
			if($taxonomy !== null) {
				return new $this->model(get_term($id, $taxonomy));
			}
			return new $this->model(get_term($id));
		}
		return null;
	}

	/**
	 *
	 * QueryBuilder
	 *
	 * @param $arg
	 * @param $val
	 * @return $this
	 */
	public function set($arg, $val)
	{
		$this->queryArgs[$arg] = $val;
		return $this;
	}

	/**
	 * @param array $append
	 * @return mixed
	 */
	public function load($append = [])
	{
		$this->query->query($this->queryArgs);
		$ret = $this->iterate($append);
		$this->clear();
		return $ret;
	}

	public function clear()
	{
		$this->queryArgs = [];
	}

	/**
	 *
	 * Query iterator
	 *
	 * @param $append
	 * @return array
	 */
	protected function iterate($append)
	{
		//print_r (self::$staticInstance->query instanceof \WP_Term_Query);
		// TODO: The ability to actually iterate over a WP_Term_Query

		// For the reset to be done correctly
		global $post;
		$tempPost = $post;

		$ret = [];
		if($this->query instanceof \WP_Term_Query) {
			foreach ($this->query->get_terms() as $item) {
				$ret[] = new $this->model($item, $this->query, $append);
			}
		}
		else {
			if ($this->query->have_posts()) {
				while ($this->query->have_posts()) {
					$this->query->the_post();
					$ret[] = new $this->model(get_post(), $this->query, $append);
				}
				wp_reset_postdata();
			}
		}
		// Hardcoded reset, wp_reset_postdata() was not restoring global $post correctly
		$GLOBALS['post'] = $tempPost;

		return $ret;
	}

	public function getQuery () {
		return $this->query;
	}
}