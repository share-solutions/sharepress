<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 05/02/2018
 * Time: 10:53
 */

namespace share\SharePress\Http;

class BaseRequest
{
	private $data;
	private $request;
	public function __construct($request = null) {
		global $wp;

		$this->data = [];
		$this->request = $request === null ? (object) $_REQUEST : (object) $request;
		$this->data['query_vars'] = $wp->query_vars;
	}

	public function __get($name)
	{
		if (property_exists($this->request, $name)) {
			return $this->request->$name;
		}
		if(isset($this->data[$name])) {
			return $this->_data[$name];
		}
		return null;
	}

	public function __set($name, $value)
	{
		$this->data[$name] = $value;
	}
}