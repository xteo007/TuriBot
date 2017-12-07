<?php


//updating messages
function editMessageText($text, $chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $parse_mode = NULL, $disable_web_page_preview = NULL, $reply_markup = NULL)
{
	$args = array(
		'text' => $text
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
	if(isset($parse_mode))
	{
		$args['parse_mode'] = $parse_mode;
	}
	if(isset($disable_web_page_preview))
	{
		$args['disable_web_page_preview'] = $disable_web_page_preview;
	}
	if(isset($reply_markup))
	{
		$reply_markup = json_encode($reply_markup);
		$args['reply_markup'] = $reply_markup;
	}
	$rr = curlRequest("editMessageText", $args);
	return $rr;
}


function editMessageCaption($chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $caption = NULL, $reply_markup = NULL)
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
	if(isset($caption))
	{
		$args['caption'] = $caption;
	}
	if(isset($reply_markup))
	{
		$reply_markup = json_encode($reply_markup);
		$args['reply_markup'] = $reply_markup;
	}
	$rr = curlRequest("editMessageCaption", $args);
	return $rr;
}


function editMessageReplyMarkup($chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $reply_markup = NULL)
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
	$rr = curlRequest("editMessageReplyMarkup", $args);
	return $rr;
}


function deleteMessage($chat_id, $message_id)
{
	$args = array(
		'chat_id' => $chat_id,
		'message_id' => $message_id,
		);
	$rr = curlRequest("deleteMessage", $args);
	return $rr;
}