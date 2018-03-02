<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 01/03/2018
 * Time: 23:11
 */

namespace share\SharePress\Install\SubCommands;

use Symfony\Component\Filesystem\Filesystem;

class DeleteWordpressThemes extends SubCommand
{
	public function run()
	{
		$themesPath = $this->getVendorPath('../wp-content/themes/');

		$themesFilesystem = scandir($themesPath);
		$fileSystem = new Filesystem();
		foreach ($themesFilesystem as $item) {
			if(stripos($item, 'twenty') !== FALSE) {
				$fileSystem->remove($themesPath . '/' . $item);
			}
		}

		return true;
	}
}