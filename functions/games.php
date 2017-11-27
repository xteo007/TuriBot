<?php


//games
function sendGame($chat_id, $game_short_name, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'game_short_name' => $game_short_name
		);
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
	$r = file_get_contents("https://api.telegram.org/bot$api/sendGame?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function setGameScore($user_id, $score, $force = NULL, $disable_edit_message = NULL, $chat_id = NULL, $message_id = NULL, $inline_message_id = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'user_id' => $user_id,
		'score' => $score
		);
	if(isset($force))
	{
		$args['force'] = $force;
	}
	if(isset($disable_edit_message))
	{
		$args['disable_edit_message'] = $disable_edit_message;
	}
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
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/setGameScore?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function getGameHighScores($user_id, $chat_id = NULL, $message_id = NULL, $inline_message_id = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'user_id' => $user_id
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
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/getGameHighScores?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}
