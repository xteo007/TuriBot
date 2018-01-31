<?php


function sendChatAction($chat_id, $action, $response = false)
{
	$args = [
		'chat_id' => $chat_id,
		'action' => $action
		];

    if($response)
    {
        $rr = curlRequest("sendChatAction", $args);
    }
    else
    {
        jsonPayload("sendChatAction", $args);
        $rr = true;
    }

    return $rr;
}


function answerCallbackQuery($callback_query_id, $text = NULL, $show_alert = NULL, $url = NULL, $cache_time = NULL, $response = false)
{
	$args = [
		'callback_query_id' => $callback_query_id
		];
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

    if($response)
    {
        $rr = curlRequest("answerCallbackQuery", $args);
    }
    else
    {
        jsonPayload("answerCallbackQuery", $args);
        $rr = true;
    }

    return $rr;
}