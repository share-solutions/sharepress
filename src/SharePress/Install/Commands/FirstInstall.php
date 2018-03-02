<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 01/03/2018
 * Time: 23:11
 */

namespace share\SharePress\Install\Commands;


use share\SharePress\Install\SubCommands\CopyTheme;
use share\SharePress\Install\SubCommands\DeleteWordpressThemes;
use share\SharePress\Install\SubCommands\InstallWordpress;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FirstInstall extends Command
{
	protected function configure()
	{
		$this
			// the name of the command (the part after "bin/console")
			->setName('setup:install')

			// the short description shown while running "php bin/console list"
			->setDescription('Installs SharePress.')

			// the full command description shown when running the command with
			// the "--help" option
			->setHelp('This command sets up and publishes SharePress dependencies and draft theme')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$pipeline = [
			new InstallWordpress($input, $output, $this),
			new DeleteWordpressThemes($input, $output, $this),
			new CopyTheme($input, $output, $this),
			// create .env file, copy new wp-config, create uploads/view_cache directory
		];

		$this->runPipeline($pipeline, 0);
	}

	private function runPipeline ($pipe, $index) {
		$item = $pipe[$index];
		$success = $item->run();
		if($success && ($index + 1) < count($pipe)) {
			$this->runPipeline($pipe, $index + 1);
		}
	}
}