<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 14:10
 */

if(isset($_GET['__flush_rewrite_rules'])) {
	flush_rewrite_rules();
}

global $shareApp;
$shareApp = new \share\SharePress\App(__DIR__ . "/../");