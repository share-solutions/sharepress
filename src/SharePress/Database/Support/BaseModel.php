<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 20/02/2018
 * Time: 22:50
 */

namespace share\SharePress\Database\Support;


use share\SharePress\Facades\Container;
use share\SharePress\Facades\Strings;
use share\SharePress\Helpers\Reflection\Reflector;

abstract class BaseModel
{
	/**
	 * @var string
	 */
	protected $postType = "post";

	/**
	 * @var string
	 */
	protected $queryType = "post";

	/**
	 * @var QueryBuilder
	 */
	protected $query;

	/**
	 * @var BaseModel
	 */
	protected static $staticInstance = null;

	protected $wpInstance;

	/**
	 * @var array
	 */
	protected $appended = [];

	/**
	 * @var array
	 */
	protected $customFields = [];

	/**
	 * BaseModel constructor.
	 * @param \WP_Query|\WP_Term_Query $query
	 * @param array $append
	 */
	public function __construct($instance = null, $query = null, $append = [])
	{
		if($instance === null) {
			//print_r ("new static");
		}
		$this->wpInstance = $instance;
		$this->query = !!$query && $query !== null ? $query : $this->newQueryBuilder();
		if(!!$append && count($append) > 0) {
			$this->append($append);
		}
	}

	/**
	 *
	 */
	public function append ($accessors) {
		foreach ($accessors as $accessor) {
			$accessorTemp = "getAttr" . Strings::slugToCamelCase($accessor, true);
			if(method_exists($this, $accessorTemp)) {
				$this->appended[$accessor] = Container::call([$this, $accessorTemp]);
			}
		}
	}

	protected function resolveArrayValue($arr, $keyPath) {
		$keyPath = explode(".", $keyPath);
		$ret = $arr;
		foreach ($keyPath as $item) {
			$ret = $ret[$item];
		}
		return $ret;
	}

	protected function newQueryBuilder () {
		if($this->queryType !== 'disabled') {
			return new QueryBuilder($this->queryType, static::class);
		}
		return null;
	}

	protected function getQueryBuilder () {
		if(!$this->query) $this->query = $this->newQueryBuilder();
		return $this->query;
	}

	/**
	 *
	 * Model instance magic method
	 *
	 * @param $name
	 * @return mixed
	 * @throws \Exception
	 */
	public function __get($name) {
		if(isset($this->wpInstance) && $this->wpInstance !== null) {
			if(property_exists($this->wpInstance, $name)) {
				return $this->wpInstance->$name;
			}
			$accessor = "getAttr" . Strings::slugToCamelCase($name, true);
			if(method_exists($this, $accessor)) {
				if(!isset($this->appended[$name])) {
					$this->appended[$name] = Container::call([$this, $accessor]);
				}
				return $this->appended[$name];
			}
			if(in_array($name, $this->customFields)) {
				return get_field($name, $this->ID);
			}
		}
		$class = static::class;
		throw new \Exception("Property ${name} not defined on Model ${class} Exception");
	}

	public function __isset($name)
	{
		if(isset($this->wpInstance) && $this->wpInstance !== null) {
			if(property_exists($this->wpInstance, $name)) {
				return true;
			}
			$accessor = "getAttr" . Strings::slugToCamelCase($name, true);
			if(method_exists($this, $accessor)) {
				return true;
			}
		}
		return false;
	}

	public static function __callStatic($name, $arguments)
	{
		$ret = static::forwardToQueryBuilder($name, $arguments);
		if($ret !== false) {
			return $ret;
		}
	}

	public function __call($name, $arguments)
	{
		$ret = static::forwardToQueryBuilder($name, $arguments);
		if($ret !== false) {
			return $ret;
		}
	}

	private static function forwardToQueryBuilder ($name, $arguments) {
		// Static instance used to store the QueryBuilder for the Model must be an instance fo our class
		if(static::$staticInstance === null || !static::$staticInstance instanceof static) {
			static::$staticInstance = new static();
		}
		// if method exists in query builder forward it
		if (method_exists(static::$staticInstance->getQueryBuilder(), $name)) {

			// allow forwarded methods to have default values naming the parameters sent,
			// all because of call_user_func_array used be the BoundMethod class in the Container
			// and the fact that it adds up the default values from parameters as new parameters for the called method

			return Container::call(
				[static::$staticInstance->getQueryBuilder(), $name],
				Reflector::mapArgumentsToMethod(static::$staticInstance->getQueryBuilder(), $name, $arguments)
			);
		}
		return false;
	}
}