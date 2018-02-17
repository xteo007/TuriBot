<?php


//updating messages
function editMessageText($text, $chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $parse_mode = NULL, $disable_web_page_preview = NULL, $reply_markup = NULL, $response = false)
{
	$args = [
		'text' => $text
		];
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

    if($response)
    {
        return curlRequest('editMessageText', $args);
    }
    else
    {
        return jsonPayload('editMessageText', $args);
    }
}


function editMessageCaption($chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $caption = NULL, $parse_mode = NULL, $reply_markup = NULL, $response = false)
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
    if(isset($parse_mode))
    {
        $args['parse_mode'] = $parse_mode;
    }
	if(isset($reply_markup))
	{
		$reply_markup = json_encode($reply_markup);
		$args['reply_markup'] = $reply_markup;
	}

    if($response)
    {
        if(isset($args))
        {
            return curlRequest('editMessageCaption', $args);
        }
        else
        {
            return curlRequest('editMessageCaption');
        }
    }
    else
    {
        if(isset($args))
        {
            return jsonPayload('editMessageCaption', $args);
        }
        else
        {
            return jsonPayload('editMessageCaption');
        }
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

    if($response)
    {
        if(isset($args))
        {
            return curlRequest('editMessageReplyMarkup', $args);
        }
        else
        {
            return curlRequest('editMessageReplyMarkup');
        }
    }
    else
    {
        if(isset($args))
        {
            return jsonPayload('editMessageReplyMarkup', $args);
        }
        else
        {
            return jsonPayload('editMessageReplyMarkup');
        }
    }
}


function deleteMessage($chat_id, $message_id, $response = false)
{
	$args = [
		'chat_id' => $chat_id,
		'message_id' => $message_id,
		];

    if($response)
    {
        return curlRequest('deleteMessage', $args);
    }
    else
    {
        return jsonPayload('deleteMessage', $args);
    }
}