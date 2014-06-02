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

	protected $urlRegEx = '%(?<url>https?://[\w\%/\?&\._\-]+)%ims';
	/**
	 * @var \GetContent\cSingleCurl
	 */
	protected $curl;

	function __construct(){
		$this->curl = new \GetContent\cSingleCurl();
		$this->curl->setTypeContent('file');
		$this->curl->setDefaultOption(CURLOPT_TIMEOUT, 10);
		$this->curl->setDefaultOption(CURLOPT_FOLLOWLOCATION, true);
	}

	public function findUrl($text){
		if(preg_match_all($this->urlRegEx,$text,$matches)){
			foreach($matches['url'] as &$url){
				$this->prepareUrl($url);
			}
			return $matches['url'];
		}
		return array();
	}

	protected function prepareUrl(&$url){}

	protected final function getFile($fileName){
		$this->curl->setDefaultOption(CURLOPT_REFERER, $fileName);
		$file = $this->curl->load($fileName);
		$filePath = \GetContent\cStringWork::parsePath($fileName);
		if(!preg_match('%torrent%i',$filePath['extension'])){
			$descriptor = $this->curl->getDescriptor();
			$filePath = \GetContent\cStringWork::parsePath($descriptor['info']['url']);
			if(!preg_match('%torrent%i',$filePath['extension'])){
				return false;
			}
		}
		$torrentName = urldecode($filePath['basename']);
		return array('name' => $torrentName, 'file' => $file);
	}

	protected function saveFile($data){
		if(!file_exists(DIR_FOR_TORRENT . $data['name'])){
			file_put_contents(DIR_FOR_TORRENT . $data['name'], $data['file']);
		}
	}

	public final function download($urlRss){
		$text = $this->curl->load($urlRss);
		foreach($this->findUrl($text) as $url){
			$info = $this->getFile($url);
			if($info){
				$this->saveFile($info);
			}
		}
	}

}