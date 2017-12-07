<?php


function sendChatAction($chat_id, $action)
{
	$args = array(
		'chat_id' => $chat_id,
		'action' => $action
		);
	$rr = curlRequest("sendChatAction", $args);
	return $rr;	
}


function answerCallbackQuery($callback_query_id, $text = NULL, $show_alert = NULL, $url = NULL, $cache_time = NULL)
{
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
	$rr = curlRequest("answerCallbackQuery", $args);
	return $rr;
}