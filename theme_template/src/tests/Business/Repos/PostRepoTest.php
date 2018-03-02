<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 21/02/2018
 * Time: 23:10
 */

namespace tests\Business\Repos;

use prevenir\Business\Models\Posts\Post;
use prevenir\Business\Repos\Posts\PostsRepo;
use PHPUnit\Framework\TestCase;
use share\SharePress\Facades\Config;

final class PostRepoTest extends TestCase
{
	public function __construct($name = null, array $data = [], $dataName = '')
	{
		Config::load('acf');
		parent::__construct($name, $data, $dataName);
	}

	public function testHomepageHighlights (): void {
		$highlights = PostsRepo::getHomepageHighlights();

		$this->assertTrue(count($highlights) > 0, "More than 0 highlights available");
		$this->assertTrue(count($highlights) === 3, "Highlights to present are different than 3");
		foreach ($highlights as $highlight) {
			$this->assertInstanceOf(Post::class, $highlight, "Highlight is not a Post instance");
		}
	}

	public function testMostRead (): void {
		$mostRead = PostsRepo::getMostRead();


		$this->assertTrue(count($mostRead) > 0, "More than 0 most read available");
		$this->assertTrue(count($mostRead) === 3, "Most Read to present are different than 3");
		foreach ($mostRead as $item) {
			$this->assertInstanceOf(Post::class, $item, "Most Read is not a Post instance");
		}
	}

}