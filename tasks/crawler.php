<?php

include __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../config/config.php';

set_time_limit(0);

use Goutte\Client;

$client = new Client();

$page = 1;
$i = 0;

while(1) {
	$crawler = $client->request('GET', sprintf('http://www.sitepoint.com/page/%d', $page));

	$articleItems = $crawler->filter('.article');
	if ($articleItems->count() == 0) {
		break;
	} else {
		$articles = [];
		$articleItems->each(function ($node) use (&$articles) {
			$categoryNode = $node->filter('header > h2 > a:nth-child(1)');
			
			if (count($categoryNode) > 0) {
				$category = $categoryNode->first()->text();
			} else {
				$category = '';
			}			
			
			$titleNode = $node->filter('section > h1 > a')->first();
			$title = $titleNode->text();
			$href = $titleNode->attr('href');
			
			$articles[] = ['category' => $category, 'title' => $title, 'href' => $href];
		});
	}	
	
	$i += count($articles);
	
	echo $page, '  ---  ', $i, PHP_EOL;
	$conn->insertMany('articles', $articles);
	
	++$page;
}