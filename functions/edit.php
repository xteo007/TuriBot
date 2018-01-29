<?php


//updating messages
function editMessageText($text, $chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $parse_mode = NULL, $disable_web_page_preview = NULL, $reply_markup = NULL, $response = false)
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

    if($response == true)
    {
        $rr = curlRequest("editMessageText", $args);
        return $rr;
    }
    else
    {
        jsonPayload("editMessageText", $args);
    }
}


function editMessageCaption($chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $caption = NULL, $reply_markup = NULL, $response = false)
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

    if($response == true)
    {
        $rr = curlRequest("editMessageCaption", $args);
        return $rr;
    }
    else
    {
        jsonPayload("editMessageCaption", $args);
    }
}


function editMessageReplyMarkup($chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $reply_markup = NULL, $response = false)
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

    if($response == true)
    {
        $rr = curlRequest("editMessageReplyMarkup", $args);
        return $rr;
    }
    else
    {
        jsonPayload("editMessageReplyMarkup", $args);
    }
}


function deleteMessage($chat_id, $message_id, $response = false)
{
	$args = array(
		'chat_id' => $chat_id,
		'message_id' => $message_id,
		);

    if($response == true)
    {
        $rr = curlRequest("deleteMessage", $args);
        return $rr;
    }
    else
    {
        jsonPayload("deleteMessage", $args);
    }
}