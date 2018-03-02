<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 21/02/2018
 * Time: 23:10
 */

namespace tests\Http\Controllers\TemplateMatch\Single;

use prevenir\Http\Controllers\TemplateMatch\Single\Index;
use PHPUnit\Framework\TestCase;
use share\SharePress\Facades\Container;
use Symfony\Component\DomCrawler\Crawler;

final class IndexTest extends TestCase
{
	public function testIndexResponse (): void {
		$crawler = $this->getPageCrawler();
		$this->assertCount(1, $crawler->filter('meta[name=\'viewport\']'), "Meta Viewport found");
		$this->assertEquals(
			0,
			preg_match(
				"/^WordPress/",
				$crawler->filter('meta[name=\'generator\']')
						->eq(0)
						->attr('content')
			),
			"Meta Generator WordPress should not be found");
	}

	private function getPageCrawler (): Crawler {

		$_SERVER['SERVER_NAME'] = 'localhost';

		global $post;
		$post = get_post(143);

		$controller = Container::make(Index::class);
		$view = Container::call([$controller, 'index']);

		$crawler = new Crawler($view);
		return $crawler;

	}
}