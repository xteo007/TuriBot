<?php


function setChatStickerSet($chat_id, $sticker_set_name)
{
	$args = array(
		'chat_id' => $chat_id,
		'sticker_set_name' => $sticker_set_name
		);
	$rr = curlRequest("setChatStickerSet", $args);
	return $rr;
}


function deleteChatStickerSet($chat_id)
{
	$args = array(
		'chat_id' => $chat_id
		);
	$rr = curlRequest("deleteChatStickerSet", $args);
	return $rr;
}


//stickers
function sendSticker($chat_id, $sticker, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	if(stripos($sticker, "http") === false)
	{
		if(stripos($sticker, ".") !== false)
		{
			$file_name = realpath($sticker);
			$sticker = curl_file_create($file_name);
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
	$rr = curlRequest("sendSticker", $args);
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


function createNewStickerSet($user_id, $name, $title, $png_sticker, $emojis, $contains_masks = NULL, $mask_position = NULL)
{
	if(stripos($png_sticker, "http") === false)
	{
		if(stripos($png_sticker, ".") !== false)
		{
			$file_name = realpath($png_sticker);
			$png_sticker = curl_file_create($file_name);
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
	$rr = curlRequest("createNewStickerSet", $args);
	return $rr;	
}


function addStickerToSet($user_id, $name, $png_sticker, $emojis, $mask_position = NULL)
{
	if(stripos($png_sticker, "http") === false)
	{
		if(stripos($png_sticker, ".") !== false)
		{
			$file_name = realpath($png_sticker);
			$png_sticker = curl_file_create($file_name);
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
	$rr = curlRequest("addStickerToSet", $args);
	return $rr;	
}


function setStickerPositionInSet($sticker, $position)
{
	$args = array(
		'sticker' => $sticker,
		'position' => $position
		);
	$rr = curlRequest("setStickerPositionInSet", $args);
	return $rr;
}


function deleteStickerFromSet($sticker)
{
	$args = array(
		'sticker' => $sticker
		);
	$rr = curlRequest("deleteStickerFromSet", $args);
	return $rr;
}