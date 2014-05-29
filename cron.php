<?php
/**
 * Created by PhpStorm.
 * User: EC
 * Date: 29.05.14
 * Time: 15:17
 * Email: bpteam22@gmail.com
 */

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config.php';

$feed = json_decode(FEED, true);

foreach($feed as $url){
	$domain = \GetContent\cStringWork::getDomainName($url);
	$class = getClassName($domain);
	if(file_exists(MOD . $class . '.php')){
		require_once MOD . $class . '.php';
		$obj = new $class();
	} else {
		$obj = new Rss();
	}



}

function getClassName($url){
	$domain = \GetContent\cStringWork::getDomainName($url, 2);
	return preg_replace('%[\.-]%', '_', $domain);
}