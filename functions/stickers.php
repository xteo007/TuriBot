<?php


function setChatStickerSet($chat_id, $sticker_set_name)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'sticker_set_name' => $sticker_set_name
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/setChatStickerSet?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function deleteChatStickerSet($chat_id)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/deleteChatStickerSet?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


//stickers
function sendSticker($chat_id, $sticker, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$file = false;
	if(stripos($sticker, "http") === false)
	{
		if(stripos($sticker, ".") !== false)
		{
			$file = true;
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
	if(!$file)
	{
		$params = http_build_query($args);
		$r = file_get_contents("https://api.telegram.org/bot$api/sendSticker?$params", false, $context);
		$rr = json_decode($r, true);
	}
	else
	{
		$rr = curlRequest("sendSticker", $args);
	}
	return $rr;	
}


function getStickerSet($name)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'name' => $name
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/getStickerSet?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function uploadStickerFile($user_id, $png_sticker)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$file_name = realpath($png_sticker);
	$png_sticker = curl_file_create($file_name);
	$args = array(
		'user_id' => $user_id,
		'png_sticker' => $png_sticker
		);
	$rr = curlRequest("sendStickerFile", $args);
	return $rr;	
}


function createNewStickerSet($user_id, $name, $title, $png_sticker, $emojis, $contains_masks = NULL, $mask_position = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$file = false;
	if(stripos($png_sticker, "http") === false)
	{
		if(stripos($png_sticker, ".") !== false)
		{
			$file = true;
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
	if(!$file)
	{
		$params = http_build_query($args);
		$r = file_get_contents("https://api.telegram.org/bot$api/createNewStickerSet?$params", false, $context);
		$rr = json_decode($r, true);
	}
	else
	{
		$rr = curlRequest("createNewStickerSet", $args);
	}
	return $rr;	
}


function addStickerToSet($user_id, $name, $png_sticker, $emojis, $mask_position = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$file = false;
	if(stripos($png_sticker, "http") === false)
	{
		if(stripos($png_sticker, ".") !== false)
		{
			$file = true;
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
	if(!$file)
	{
		$params = http_build_query($args);
		$r = file_get_contents("https://api.telegram.org/bot$api/addStickerToSet?$params", false, $context);
		$rr = json_decode($r, true);
	}
	else
	{
		$rr = curlRequest("addStickerToSet", $args);
	}
	return $rr;	
}


function setStickerPositionInSet($sticker, $position)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'sticker' => $sticker,
		'position' => $position
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/setStickerPositionInSet?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function deleteStickerFromSet($sticker)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'sticker' => $sticker
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/deleteStickerFromSet?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}