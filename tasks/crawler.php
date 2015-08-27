<?php

include __DIR__ . '/../vendor/autoload.php';

set_time_limit(0);

use Goutte\Client;

$client = new Client();

$articles = [];

$page = 1;
while(1) {
	$crawler = $client->request('GET', sprintf('http://www.sitepoint.com/page/%d', $page));

	$articleItems = $crawler->filter('.article');
	if ($articleItems->count() == 0) {
		break;
	} else {
		$article = [];
		$articleItems->each(function ($node) use (&$article) {
			
			
		});
	}	

	++$page;
	
	die;
}