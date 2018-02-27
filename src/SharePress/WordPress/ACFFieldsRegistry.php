<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 11/02/2018
 * Time: 23:59
 */

namespace share\SharePress\WordPress;


trait ACFFieldsRegistry
{
	protected $acfRegisterMethod;
	protected function generateKey ($slug) {
		return md5(self::class . $slug);
	}

	protected function setACFRegisterMethod () {
		$acfVersion = $this->getACFVersion();
		if(preg_match("/^4/", $acfVersion)) {
			$this->acfRegisterMethod = "register_field_group";
		}
		else if (preg_match("/^5/", $acfVersion)) {
			$this->acfRegisterMethod = "acf_add_local_field_group";
		}
	}

	protected function getACFVersion () {
		if(class_exists('acf')) {
			global $acf;
			return $acf->version;
		}
		return null;
	}
}