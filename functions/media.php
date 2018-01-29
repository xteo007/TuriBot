<?php


//$photo = file_id or http url or file
//example = "11111111" or "http://your_website.com/photo.jpg" or "photo.jpg" (in same directory)
function sendPhoto($chat_id, $photo, $caption = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
	if(stripos($photo, "http") === false)
	{
		if(stripos($photo, ".") !== false)
		{
			$file_name = realpath($photo);
			$photo = curl_file_create($file_name);
            $response = true;
		}
	}
	$args = array(
		'chat_id' => $chat_id,
		'photo' => $photo
		);
	if(isset($caption))
	{
		$args['caption'] = $caption;
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

    if($response == true)
    {
        $rr = curlRequest("sendPhoto", $args);
    }
    else
    {
        jsonPayload("sendPhoto", $args);
        $rr = true;
    }

    return $rr;
}


function sendAudio($chat_id, $audio, $caption = NULL, $duration = NULL, $performer = NULL, $title = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
	if(stripos($audio, "http") === false)
	{
		if(stripos($audio, ".") !== false)
		{
			$file_name = realpath($audio);
			$audio = curl_file_create($file_name);
            $response = true;
		}
	}
	$args = array(
		'chat_id' => $chat_id,
		'audio' => $audio
		);
	if(isset($caption))
	{
		$args['caption'] = $caption;
	}
	if(isset($duration))
	{
		$args['duration'] = $duration;
	}
	if(isset($performer))
	{
		$args['performer'] = $performer;
	}
	if(isset($title))
	{
		$args['title'] = $title;
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

    if($response == true)
    {
        $rr = curlRequest("sendAudio", $args);
    }
    else
    {
        jsonPayload("sendAudio", $args);
        $rr = true;
    }

    return $rr;
}


function sendDocument($chat_id, $document, $caption = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
    if (stripos($document, "http") === false) {
        if (stripos($document, ".") !== false) {
            $file_name = realpath($document);
            $document = curl_file_create($file_name);
            $response = true;
        }
    }
    $args = array(
        'chat_id' => $chat_id,
        'document' => $document
    );
    if (isset($caption)) {
        $args['caption'] = $caption;
    }
    if (isset($disable_notification)) {
        $args['disable_notification'] = $disable_notification;
    }
    if (isset($reply_to_message_id)) {
        $args['reply_to_message_id'] = $reply_to_message_id;
    }
    if (isset($reply_markup)) {
        $reply_markup = json_encode($reply_markup);
        $args['reply_markup'] = $reply_markup;
    }

    if ($response == true) {
        $rr = curlRequest("sendDocument", $args);
    } else {
        jsonPayload("sendDocument", $args);
        $rr = true;
    }

    return $rr;
}


function sendVideo($chat_id, $video, $duration = NULL, $width = NULL, $height = NULL, $caption = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
    if (stripos($video, "http") === false) {
        if (stripos($video, ".") !== false) {
            $file_name = realpath($video);
            $video = curl_file_create($file_name);
            $response = true;
        }
    }
    $args = array(
        'chat_id' => $chat_id,
        'video' => $video
    );
    if (isset($duration)) {
        $args['duration'] = $duration;
    }
    if (isset($width)) {
        $args['width'] = $width;
    }
    if (isset($height)) {
        $args['height'] = $height;
    }
    if (isset($caption)) {
        $args['caption'] = $caption;
    }
    if (isset($disable_notification)) {
        $args['disable_notification'] = $disable_notification;
    }
    if (isset($reply_to_message_id)) {
        $args['reply_to_message_id'] = $reply_to_message_id;
    }
    if (isset($reply_markup)) {
        $reply_markup = json_encode($reply_markup);
        $args['reply_markup'] = $reply_markup;
    }

    if ($response == true) {
        $rr = curlRequest("sendVideo", $args);
    } else {
        jsonPayload("sendVideo", $args);
        $rr = true;
    }

    return $rr;
}

function sendVoice($chat_id, $voice, $caption = NULL, $duration = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
	if(stripos($voice, "http") === false)
	{
		if(stripos($voice, ".") !== false)
		{
			$file_name = realpath($voice);
			$voice = curl_file_create($file_name);
            $response = true;
		}
	}
	$args = array(
		'chat_id' => $chat_id,
		'voice' => $voice
		);
	if(isset($caption))
	{
		$args['caption'] = $caption;
	}
	if(isset($duration))
	{
		$args['duration'] = $duration;
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

    if($response == true)
    {
        $rr = curlRequest("sendVoice", $args);
    }
    else
    {
        jsonPayload("sendVoice", $args);
        $rr = true;
    }

    return $rr;
}

//Sending video notes by a URL is currently unsupported by Telegram (Bot Api 3.4) https://core.telegram.org/bots/api#sendvideonote
function sendVideoNote($chat_id, $video_note, $duration = NULL, $length = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
	if(stripos($video_note, "http") === false)
	{
		if(stripos($video_note, ".") !== false)
		{
			$file_name = realpath($video_note);
			$video_note = curl_file_create($file_name);
            $response = true;
		}
	}
	$args = array(
		'chat_id' => $chat_id,
		'video_note' => $video_note
		);
	if(isset($duration))
	{
		$args['duration'] = $duration;
	}
	if(isset($length))
	{
		$args['length'] = $length;
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

    if($response == true)
    {
        $rr = curlRequest("sendVideoNote", $args);
    }
    else
    {
        jsonPayload("sendVideoNote", $args);
        $rr = true;
    }

    return $rr;
}


//in $media send array of InputMedia, for now it only supports sending via id or link https://core.telegram.org/bots/api#sendmediagroup
function sendMediaGroup($chat_id, $media, $disable_notification = NULL, $reply_to_message_id = NULL)
{
	$media = json_encode($media);
	$args = array(
		'chat_id' => $chat_id,
		'media' => $media
		);
	if(isset($disable_notification))
	{
		$args['disable_notification'] = $disable_notification;
	}
	if(isset($reply_to_message_id))
	{
		$args['reply_to_message_id'] = $reply_to_message_id;
	}

    $rr = curlRequest("sendMediaGroup", $args);
    return $rr;
}


function sendContact($chat_id, $phone_number, $first_name, $last_name, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
	$args = array(
		'chat_id' => $chat_id,
		'phone_number' => $phone_number,
		'first_name' => $first_name
		);
	if(isset($last_name))
	{
		$args['last_name'] = $last_name;
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

    if($response == true)
    {
        $rr = curlRequest("sendContact", $args);
    }
    else
    {
        jsonPayload("sendContact", $args);
        $rr = true;
    }

    return $rr;
}