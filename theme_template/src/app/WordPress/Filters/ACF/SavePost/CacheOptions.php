<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace prevenir\WordPress\Filters\ACF\SavePost;

use share\SharePress\Facades\App;
use share\SharePress\WordPress\FilterObserver;

class CacheOptions extends FilterObserver
{
	public $filter = "acf/save_post";

	public function handler($post_id)
	{
		if($post_id === 'options') {
			$acfConfigFile = App::getDirectory("config/acf.php");
			$contents = "<?php return " . var_export(get_fields('options'), true) . ";";
			$handle = fopen($acfConfigFile, 'w') or die('Cannot open file:  ' . $acfConfigFile);
			fwrite($handle, $contents);
			fclose($handle);
		}
	}
}