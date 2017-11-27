<?php


function sendLocation($chat_id, $latitude, $longitude, $live_period = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'latitude' => $latitude,
		'longitude' => $longitude
		);
	if(isset($live_period))
	{
		$args['live_period'] = $live_period;
	}
	if(isset($disable_notification))
	{
		$args['disable_notification'] = $disable_notification;
	}
	if(isset($reply_to_message_id))
	{
		$args['reply_to_message_id'] = $reply_to_message_id;
	}
	if(isset($reply_markup))
	{
		$reply_markup = json_encode($reply_markup);
		$args['reply_markup'] = $reply_markup;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/sendLocation?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;	
}


function editMessageLiveLocation($latitude, $longitude, $chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'latitude' => $latitude,
		'longitude' => $longitude
		);
	if(isset($chat_id))
	{
		$args['chat_id'] = $chat_id;
	}
	if(isset($message_id))
	{
		$args['message_id'] = $message_id;
	}
	if(isset($inline_message_id))
	{
		$args['inline_message_id'] = $inline_message_id;
	}
	if(isset($reply_markup))
	{
		$reply_markup = json_encode($reply_markup);
		$args['reply_markup'] = $reply_markup;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/editMessageLiveLocation?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;	
}


function stopMessageLiveLocation($chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	if(isset($chat_id))
	{
		$args['chat_id'] = $chat_id;
	}
	if(isset($message_id))
	{
		$args['message_id'] = $message_id;
	}
	if(isset($inline_message_id))
	{
		$args['inline_message_id'] = $inline_message_id;
	}
	if(isset($reply_markup))
	{
		$reply_markup = json_encode($reply_markup);
		$args['reply_markup'] = $reply_markup;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/stopMessageLiveLocation?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;	
}


function sendVenue($chat_id, $latitude, $longitude, $title, $address, $foursquare_id = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'latitude' => $latitude,
		'longitude' => $longitude,
		'title' => $title,
		'address' => $address
		);
	if(isset($foursquare_id))
	{
		$args['foursquare_id'] = $foursquare_id;
	}
	if(isset($message_id))
	{
		$args['message_id'] = $message_id;
	}
	if(isset($inline_message_id))
	{
		$args['inline_message_id'] = $inline_message_id;
	}
	if(isset($disable_notification))
	{
		$args['disable_notification'] = $disable_notification;
	}
	if(isset($reply_to_message_id))
	{
		$args['reply_to_message_id'] = $reply_to_message_id;
	}
	if(isset($reply_markup))
	{
		$reply_markup = json_encode($reply_markup);
		$args['reply_markup'] = $reply_markup;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/sendVenue?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;	
}