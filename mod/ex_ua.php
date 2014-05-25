<?php
/**
 * Created by PhpStorm.
 * User: EC
 * Date: 25.05.14
 * Time: 3:09
 * Project: torrent-rss-parser-download
 * @author: Evgeny Pynykh bpteam22@gmail.com
 */

class ex_ua extends Parser{

	function __construct(){
		parent::__construct();
	}

	protected function prepareUrl(&$url){
		$url = str_replace('/get/','/torrent/', $url);
	}
} 