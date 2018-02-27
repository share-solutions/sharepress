<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 17:54
 */

namespace share\SharePress\Http;

use share\SharePress\Facades\Strings;

abstract class BaseAjaxController
{
	protected $localizerHandle;

	public function handlerName()
	{
		if (!!property_exists($this, 'handler')) {
			return $this->handler;
		}
		return $this->getSlug();
	}

	public function scriptLocalizer()
	{
		// Register ajax request
		if (!empty($this->localizerHandle)) {
			wp_localize_script(
				$this->localizerHandle,
				$this->getSlug() . "_handler",
				array(
					'url' => admin_url('admin-ajax.php'),
					'nonce' => wp_create_nonce($this->getSlug() . "_nonce"),
				)
			);
		}
	}

	protected function validateNonce()
	{
		if (!wp_verify_nonce($_REQUEST['nonce'], $this->getSlug() . "_nonce")) {
			wp_send_json_error("Invalid nonce");
			die;
		}
	}

	protected function getSlug()
	{
		$qualifiedClassName = get_class($this);
		// get only the class itself
		$singleClassName = explode("\\", $qualifiedClassName);
		$singleClassName = $singleClassName[count($singleClassName) - 1];
		// remove "Controller" from the end if it's there
		if (stripos($singleClassName, "Controller") === strlen($singleClassName) - strlen("Controller")) {
			$singleClassName = substr($singleClassName, 0, strlen($singleClassName) - strlen("Controller"));
		}
		// transform its name to lower snake case (ex: Step2ExperiencesController => step2_experiences)
		$slug = Strings::camelCaseToSnake($singleClassName);
		return $slug;
	}
}