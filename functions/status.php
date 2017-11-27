<?php


function sendChatAction($chat_id, $action)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'action' => $action
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/sendChatAction?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;	
}


function answerCallbackQuery($callback_query_id, $text = NULL, $show_alert = NULL, $url = NULL, $cache_time = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'callback_query_id' => $callback_query_id
		);
	if(isset($text))
	{
		$args['text'] = $text;
	}
	if(isset($show_alert))
	{
		$args['show_alert'] = $show_alert;
	}
	if(isset($url))
	{
		$args['url'] = $url;
	}
	if(isset($cache_time))
	{
		$args['cache_time'] = $cache_time;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/answerCallbackQuery?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}