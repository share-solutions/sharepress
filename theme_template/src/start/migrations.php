<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 14:10
 */
require_once __DIR__ . "/../vendor/autoload.php";

require_once __DIR__ . "/../../../../../phpdotenv/autoloader.php";
$dotenv = new Dotenv\Dotenv(__DIR__ . "/../../../../../");
$dotenv->load();

/*
// Lab
if ( defined('WP_HOME') && WP_HOME == 'https://shareprd.pt/' ) {
	$inDevelopment = true;
}

// QA
if ( defined(WP_ENV) && WP_ENV == 'QA' ) {
	$inDevelopment = true;
}
*/

global $shareAppMigrator;
$shareAppMigrator = new \share\SharePress\Database\Migrator(__DIR__ . "/../", array_slice($argv, 1), true);