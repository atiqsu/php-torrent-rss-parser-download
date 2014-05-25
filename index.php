<?php
/**
 * Created by PhpStorm.
 * User: EC
 * Date: 24.05.14
 * Time: 19:46
 * Project: php-torrent-rss-parser-download
 * @author: Evgeny Pynykh bpteam22@gmail.com
 */
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'config.php';
$data = json_decode(file_get_contents(CONFIG), true);
if(isset($_REQUEST['action'])){
	$query = $_REQUEST;
	switch($query['action']){
		case 'add':
			$data[md5($query['rss'])] = array('desc' => $query['desc'], 'rss' => $query['rss']);
			break;
		case 'delete':
			unset($data[$query['hash']]);
			break;
		default:
			exit('WTF?');
	}
	file_put_contents(CONFIG, json_encode($data));
}
?>

<form method="POST">
	<input name="action" type="hidden" value="add">
	Description: <input name="desc" type="text"><br/>
	RSS: <input name="rss" type="text"><br/>
	<input type="submit" value="Save">
</form>
<table>
<tr>
	<th>Description</th>
	<th>RSS</th>
	<th>Delete</th>
</tr>
<?
if(is_array($data) && $data){
	foreach($data as $hash => $rss){
?>
		<tr>
			<td><?=$rss['desc']?></td>
			<td><?=$rss['rss']?></td>
			<td><a href="?action=delete&hash=<?=$hash?>">Delete</a></td>
		</tr>
<?
	}
} else {
?>
	NO RSS FEED
<?
}
?>
</table>