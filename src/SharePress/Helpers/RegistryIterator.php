<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 23/02/2018
 * Time: 23:50
 */

namespace share\SharePress\Helpers;

// http://php.net/manual/en/class.iterator.php

abstract class RegistryIterator implements \Iterator
{
	private $position = 0;
	protected $data = [];
	private $keys = [];

	public function __construct() {
		$this->position = 0;
	}

	public function rewind() {
		$this->position = 0;
	}

	public function current() {
		return $this->data[$this->keys[$this->position]];
	}

	public function key() {
		return $this->keys[$this->position];
	}

	public function next() {
		++$this->position;
	}

	public function valid() {
		return isset($this->keys[$this->position]) && isset($this->data[$this->keys[$this->position]]);
	}

	public function add ($key, $value) {
		$this->data[$key] = $value;
		$this->keys = array_keys($this->data);
	}

	public function get ($key) {
		return $this->data[$key];
	}

	public function all () {
		return $this->data;
	}
}