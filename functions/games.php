<?php


//games
function sendGame($chat_id, $game_short_name, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
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
	$rr = curlRequest("sendGame", $args);
	return $rr;
}


function setGameScore($user_id, $score, $force = NULL, $disable_edit_message = NULL, $chat_id = NULL, $message_id = NULL, $inline_message_id = NULL)
{
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
	$rr = curlRequest("setGameScore", $args);
	return $rr;
}


function getGameHighScores($user_id, $chat_id = NULL, $message_id = NULL, $inline_message_id = NULL)
{
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
	$rr = curlRequest("getGameHighScores", $args);
	return $rr;
}
