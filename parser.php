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
		$this->regEx = '%(?<url>http://[\w'.preg_quote('%/?&._-','%').']+)%ims';
		$this->curl = new \GetContent\cSingleCurl();
		$this->curl->setTypeContent('file');
		$this->curl->setDefaultOption(CURLOPT_TIMEOUT, 10);
		$this->curl->setDefaultOption(CURLOPT_FOLLOWLOCATION, true);
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

	protected function getFile($fileName){
		$this->curl->setDefaultOption(CURLOPT_REFERER, $fileName);
		$file = $this->curl->load($fileName);
		if(!preg_match('%/(?<file_name>[^/]+\.torrent)($|/)%i',$fileName,$match)){
			$descriptor = $this->curl->getDescriptor();
			if(!isset($descriptor['info']['url']) || !preg_match('%/(?<file_name>[^/]+\.torrent)($|/)%i',$descriptor['info']['url'],$match)){
				return false;
			}
		}
		$torrentName = urldecode($match['file_name']);
		return array('name' => $torrentName, 'file' => $file);
	}

	protected function saveFile($data){
		if(!file_exists(DIR_FOR_TORRENT . $data['name'])){
			file_put_contents(DIR_FOR_TORRENT . $data['name'], $data['file']);
		}
	}

	public function download($urlRss){
		$text = $this->curl->load($urlRss);
		foreach($this->findUrl($text) as $url){
			$info = $this->getFile($url);
			if($info){
				$this->saveFile($info);
			}
		}
	}

}