<?php


function sendLocation($chat_id, $latitude, $longitude, $live_period = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
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
	$rr = curlRequest("sendLocation", $args);
	return $rr;	
}


function editMessageLiveLocation($latitude, $longitude, $chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $reply_markup = NULL)
{
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
	$rr = curlRequest("editMessageLiveLocation", $args);
	return $rr;	
}


function stopMessageLiveLocation($chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $reply_markup = NULL)
{
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
	$rr = curlRequest("stopMessageLiveLocation", $args);
	return $rr;	
}


function sendVenue($chat_id, $latitude, $longitude, $title, $address, $foursquare_id = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
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
	$rr = curlRequest("sendVenue", $args);
	return $rr;	
}
