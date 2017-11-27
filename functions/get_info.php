<?php


function getUserProfilePhotos($user_id, $offset = NULL, $limit = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'user_id' => $user_id
		);
	if(isset($offset))
	{
		$args['offset'] = $offset;
	}
	if(isset($limit))
	{
		$args['limit'] = $limit;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/getUserProfilePhotos?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


//$info = getFile("11111111"); $file_path = $info['file_path']; $download link = "https://api.telegram.org/file/bot$info/$file_path" //max 20MB https://core.telegram.org/bots/api#getfile
function getFile($file_id)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'file_id' => $file_id
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/getFile?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function getChat($chat_id)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/getChat?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}
