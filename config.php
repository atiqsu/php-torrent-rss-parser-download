<?php
/**
 * Created by PhpStorm.
 * User: EC
 * Date: 24.05.14
 * Time: 19:50
 * Project: php-torrent-rss-parser-download
 * @author: Evgeny Pynykh bpteam22@gmail.com
 */
error_reporting(E_ALL);
define('ROOT_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('DIR_FOR_TORRENT', '/mnt/myhdd/dropbox/torrent/');
define('FEED', ROOT_DIR . 'feed.json');
define('MOD', ROOT_DIR . 'mod' . DIRECTORY_SEPARATOR);
require_once ROOT_DIR . 'parser.php';
require_once MOD . 'rss.php';
require_once ROOT_DIR . '..' . DIRECTORY_SEPARATOR . '_coolLib' . DIRECTORY_SEPARATOR . 'loader-curl-phantomjs-proxy' . DIRECTORY_SEPARATOR . 'include.php';
