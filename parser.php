<?php
/**
 * Created by PhpStorm.
 * User: EC
 * Date: 24.05.14
 * Time: 19:46
 * Project: php-torrent-rss-parser-download
 * @author: Evgeny Pynykh bpteam22@gmail.com
 */

class Parser{

	protected $regEx;
	/**
	 * @var \GetContent\cSingleCurl
	 */
	protected $curl;

	function __construct(){
		$this->regEx = '%(?<url>http://[\w'.preg_quote('%/?&._-','%').'])%ims';
		$this->curl = new \GetContent\cSingleCurl();
		$this->curl->setTypeContent('file');
	}

	public function findUrl($text){
		if(preg_match_all($this->regEx,$text,$matches)){
			foreach($matches['url'] as &$url){
				$this->prepareUrl($url);
			}
			return $matches['url'];
		}
		return array();
	}

	protected function prepareUrl(&$url){}

	protected function checkFile($fileName){
		if(preg_match('%\.torrent$%i',$fileName)){

		}
	}

	public function download($urlRss){
		$text = $this->curl->load($urlRss);
		$urls = $this->findUrl($text);
		foreach($urls as $url){

		}
	}

}