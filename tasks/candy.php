<?php

include __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../config/config.php';

set_time_limit(0);

// $client = new GuzzleHttp\Client;

use Goutte\Client;

$client = new Client();

// $crawler = $client->request('GET', 'http://zero.local/ac.html');

// $nodes = $crawler->filter('.ChannelsNav');

// var_dump($nodes->first()->parents());

// die;
// if ($res->getStatusCode() == 200) {
// 	file_put_contents('ac.html', $res->getBody());
// }



$path = '/var/www/zero/ac.html';

$doc = new DOMDocument(5, 'UTF-8');

if (@$doc->loadHTMLFile($path)) {
	$xpath = new DOMXPath($doc);
	// $body = $doc->getElementsByTagName('body')->item(0);
	
	$nodeList = $xpath->evaluate("/html/body/div[1]", $doc);
	
	$node = $nodeList->item(0);
	
	var_dump($node->textContent);die;
	
	$node->parentNode->removeChild($node);
	// $doc->removeChild($node);
	
	$ret = $doc->saveXML();
	
	file_put_contents('/var/www/zero/ab.html', $ret);
}
// echo $doc->saveHTML();

die;

$html = file_get_contents($path);

$result = preg_replace("#" . preg_quote('<header class="main-header" role="banner">') .'(.*)'. preg_quote('</header>') . "#sm", '', $html);

$result = preg_replace("#" . preg_quote('<div class="ChannelsNav">') .'(.*)'. preg_quote('</div>') . "#sm", '', $result);

file_put_contents('/var/www/zero/ab.html', $result);
