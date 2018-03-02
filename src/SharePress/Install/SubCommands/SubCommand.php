<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 02/03/2018
 * Time: 00:51
 */

namespace share\SharePress\Install\SubCommands;


use Composer\Autoload\ClassLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class SubCommand
{
	protected $input;
	protected $output;
	protected $command;

	public function __construct(InputInterface $input, OutputInterface $output, Command $command)
	{
		$this->input = $input;
		$this->output = $output;
		$this->command = $command;
	}

	public function run () {

	}

	protected function getVendorPath($append = "")
	{
		$reflector = new \ReflectionClass(ClassLoader::class);
		$vendorPath = preg_replace('/^(.*)\/composer\/ClassLoader\.php$/', '$1', $reflector->getFileName() );
		if($vendorPath && is_dir($vendorPath)) {
			return $vendorPath . '/' . $append;
		}
		throw new \RuntimeException('Unable to detect vendor path.');
	}
}