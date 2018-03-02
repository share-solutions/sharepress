<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 01/03/2018
 * Time: 23:11
 */

namespace share\SharePress\Install\SubCommands;

use share\SharePress\Helpers\Strings;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Filesystem\Filesystem;

class CopyTheme extends SubCommand
{
	private $themeSource = 'theme_template';
	private $themeDestination = 'wp-content/themes/{userdefined}';

	public function run()
	{
		list($themeName, $themeSlug) = $this->getThemeNameAndSlug();
		$this->copyTemplateToThemes($themeSlug);
		$this->modifyAppNamespaceOnComposerToThemeSrc($themeSlug);

		return true;
	}

	private function getThemeNameAndSlug () {
		$helper = $this->command->getHelper('question');
		$question = new Question('Please enter the name of the theme   ', 'SharePress Theme');

		$themeName = $helper->ask($this->input, $this->output, $question);

		$themeSlug = (new Strings())->camelCaseToSnake(str_replace(" ", "", $themeName));

		$this->output->writeln("Theme Name: " . $themeName);
		$this->output->writeln("Theme Slug: " . $themeSlug);

		return [$themeName, $themeSlug];
	}

	private function copyTemplateToThemes ($themeSlug) {
		$themeSource = $this->getVendorPath('../' . $this->themeSource);
		$themeDestination = $this->getVendorPath('../' . str_replace('{userdefined}', $themeSlug, $this->themeDestination));

		$fileSystem = new Filesystem();
		$fileSystem->mirror($themeSource, $themeDestination);
	}

	private function modifyAppNamespaceOnComposerToThemeSrc($themeSlug) {
		$composer = file_get_contents($this->getVendorPath('../composer.json'));

		$composer = json_decode($composer, true);
		$themeDestination = str_replace('{userdefined}', $themeSlug, $this->themeDestination);
		if(!isset($composer['autoload']['psr-4'])) {
			$composer['autoload']['psr-4'] = [];
		}
		if(!isset($composer['autoload']['files'])) {
			$composer['autoload']['files'] = [];
		}
		$composer['autoload']['psr-4']['app\\'] = $themeDestination . '/src/app/';
		$composer['autoload']['psr-4']['database\\'] = $themeDestination . '/src/database/';
		$composer['autoload']['files'][] = $themeDestination . '/src/app/helpers.php';

		file_put_contents($this->getVendorPath('../composer.json'), json_encode($composer, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
	}
}