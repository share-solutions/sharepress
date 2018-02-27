<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace share\SharePress\WordPress\Security\Actions;

use share\SharePress\WordPress\ActionObserver;

class AdvancedFingerprintingResponse extends ActionObserver
{
	public $action = "init";
	public $priority = 100;
	public function handler () {
		if (isset($_GET['advanced_fingerprinting'])) {
			switch ($_GET['advanced_fingerprinting']) {
				case '1':
					// Unpack file
					$file = gzopen(ABSPATH.'wp-includes/js/tinymce/wp-tinymce.js.gz', 'rb');
					// Add comment
					$out = '// '.uniqid(true)."\n";
					while(!gzeof($file)) {
						$out .= gzread($file, 4096);
					}

					// Pack again
					header('Content-type: application/x-gzip');
					echo gzencode($out);
					break;

				default:
					status_header(404);
			}

			die();
		}
	}
}