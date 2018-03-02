<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 01/03/2018
 * Time: 23:11
 */

namespace share\SharePress\Install\SubCommands;

use Composer\Autoload\ClassLoader;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Filesystem\Filesystem;

class InstallWordpress extends SubCommand
{
	// https://github.com/WordPress/WordPress/archive/4.9.4.zip
	private $wordpressVersions = [
		'4.9.2' => 'https://github.com/WordPress/WordPress/archive/4.9.2.zip',
		'4.9.3' => 'https://github.com/WordPress/WordPress/archive/4.9.3.zip',
		'4.9.4' => 'https://github.com/WordPress/WordPress/archive/4.9.4.zip',
	];

	public function run()
	{
		$version = $this->askForVersion($this->input, $this->output);
		$this->downloadAndExtract($this->input, $this->output, $version);

		return true;
	}

	private function askForVersion (InputInterface $input, OutputInterface $output) {
		$wordpressVersionsKeys = array_keys($this->wordpressVersions);
		$helper = $this->command->getHelper('question');
		$question = new ChoiceQuestion(
			'Please select your WordPress Version (defaults to ' . $wordpressVersionsKeys[count($wordpressVersionsKeys) - 1] . ')',
			$wordpressVersionsKeys,
			count($wordpressVersionsKeys) - 1
		);
		$question->setErrorMessage('Version %s is invalid.');

		$version = $helper->ask($input, $output, $question);
		$output->writeln('You have just selected: ' . $version . ' -- ' . $this->wordpressVersions[$version]);
		return $version;
	}

	private function downloadAndExtract (InputInterface $input, OutputInterface $output, $version) {
		$rootPath = $this->getVendorPath('../');
		$output->writeln('Downloading WordPress... Please wait');
		$f = file_put_contents($rootPath . "wordpress.zip", fopen($this->wordpressVersions[$version], 'r'), LOCK_EX);
		if(FALSE === $f)
			die("Couldn't write to file.");
		$zip = new \ZipArchive();
		$res = $zip->open($rootPath . 'wordpress.zip');
		if ($res === TRUE) {
			$zip->extractTo($rootPath);
			$zip->close();
			unlink($rootPath . 'wordpress.zip');
			// WordPress gets unzipped into a WordPress-M.m.p folder, just move all its contents to the rootPath
			$rootFilesystem = scandir($rootPath);
			$fileSystem = new Filesystem();
			foreach ($rootFilesystem as $item) {
				if(stripos($item, 'WordPress') !== FALSE) {
					$fileSystem->mirror($rootPath . '/' . $item, $rootPath);
					$fileSystem->remove($rootPath . '/' . $item);
					break;
				}
			}
			//
		} else {
			//
		}
	}
}