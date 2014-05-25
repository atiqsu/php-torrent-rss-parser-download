<?php
/**
 * Created by PhpStorm.
 * User: EC
 * Date: 24.05.14
 * Time: 19:50
 * Project: php-torrent-rss-parser-download
 * @author: Evgeny Pynykh bpteam22@gmail.com
 */
define('DIR_FOR_TORRENT', '/mnt/myhdd/dropbox/torrent');
define('CONFIG', dirname(__FILE__) . DIRECTORY_SEPARATOR .'feed.json');
define('MOD', dirname(__FILE__) . DIRECTORY_SEPARATOR .'mod' . DIRECTORY_SEPARATOR);

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '_coolLib' . DIRECTORY_SEPARATOR . 'loader-curl-phantomjs-proxy' . DIRECTORY_SEPARATOR . 'include.php';
