<?php


function setChatStickerSet($chat_id, $sticker_set_name, $response = false)
{
	$args = array(
		'chat_id' => $chat_id,
		'sticker_set_name' => $sticker_set_name
		);

    if($response == true)
    {
        $rr = curlRequest("setChatStickerSet", $args);
    }
    else
    {
        jsonPayload("setChatStickerSet", $args);
        $rr = true;
    }

    return $rr;
}


function deleteChatStickerSet($chat_id, $response = false)
{
	$args = array(
		'chat_id' => $chat_id
		);

    if($response == true)
    {
        $rr = curlRequest("deleteChatStickerSet", $args);
    }
    else
    {
        jsonPayload("deleteChatStickerSet", $args);
        $rr = true;
    }

    return $rr;
}


//stickers
function sendSticker($chat_id, $sticker, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
	if(stripos($sticker, "http") === false)
	{
		if(stripos($sticker, ".") !== false)
		{
			$file_name = realpath($sticker);
			$sticker = curl_file_create($file_name);
            $response = true;
        }
	}
	$args = array(
		'chat_id' => $chat_id,
		'sticker' => $sticker
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

    if($response == true)
    {
        $rr = curlRequest("sendSticker", $args);
    }
    else
    {
        jsonPayload("sendSticker", $args);
        $rr = true;
    }

    return $rr;
}


function getStickerSet($name)
{
	$args = array(
		'name' => $name
		);

    $rr = curlRequest("getStickerSet", $args);
    return $rr;
}


function uploadStickerFile($user_id, $png_sticker)
{
	$file_name = realpath($png_sticker);
	$png_sticker = curl_file_create($file_name);
	$args = array(
		'user_id' => $user_id,
		'png_sticker' => $png_sticker
		);

    $rr = curlRequest("uploadStickerFile", $args);
    return $rr;
}


function createNewStickerSet($user_id, $name, $title, $png_sticker, $emojis, $contains_masks = NULL, $mask_position = NULL, $response = false)
{
	if(stripos($png_sticker, "http") === false)
	{
		if(stripos($png_sticker, ".") !== false)
		{
			$file_name = realpath($png_sticker);
			$png_sticker = curl_file_create($file_name);
			$response = true;
		}
	}
	$args = array(
		'user_id' => $user_id,
		'name' => $name,
		'title' => $title,
		'png_sticker' => $png_sticker,
		'emojis' => $emojis
		);
	if(isset($contains_masks))
	{
		$args['contains_masks'] = $contains_masks;
	}
	if(isset($mask_position))
	{
		$mask_position = json_encode($mask_position);
		$args['mask_position'] = $mask_position;
	}

    if($response == true)
    {
        $rr = curlRequest("createNewStickerSet", $args);
    }
    else
    {
        jsonPayload("createNewStickerSet", $args);
        $rr = true;
    }

    return $rr;
}


function addStickerToSet($user_id, $name, $png_sticker, $emojis, $mask_position = NULL, $response = false)
{
	if(stripos($png_sticker, "http") === false)
	{
		if(stripos($png_sticker, ".") !== false)
		{
			$file_name = realpath($png_sticker);
			$png_sticker = curl_file_create($file_name);
            $response = true;
        }
	}
	$args = array(
		'user_id' => $user_id,
		'name' => $name,
		'png_sticker' => $png_sticker,
		'emojis' => $emojis
		);
	if(isset($mask_position))
	{
		$mask_position = json_encode($mask_position);
		$args['mask_position'] = $mask_position;
	}

    if($response == true)
    {
        $rr = curlRequest("addStickerToSet", $args);
    }
    else
    {
        jsonPayload("addStickerToSet", $args);
        $rr = true;
    }

    return $rr;
}


function setStickerPositionInSet($sticker, $position, $response = false)
{
	$args = array(
		'sticker' => $sticker,
		'position' => $position
		);

    if($response == true)
    {
        $rr = curlRequest("setStickerPositionInSet", $args);
    }
    else
    {
        jsonPayload("setStickerPositionInSet", $args);
        $rr = true;
    }

    return $rr;
}


function deleteStickerFromSet($sticker, $response = false)
{
	$args = array(
		'sticker' => $sticker
		);

    if($response == true)
    {
        $rr = curlRequest("deleteStickerFromSet", $args);
    }
    else
    {
        jsonPayload("deleteStickerFromSet", $args);
        $rr = true;
    }

    return $rr;
}