<?php


//$photo = file_id or http url or file
//example = "11111111" or "http://your_website.com/photo.jpg" or "photo.jpg" (in same directory)
function sendPhoto($chat_id, $photo, $caption = NULL, $parse_mode = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
	if(stripos($photo, 'http') === false)
	{
		if(stripos($photo, '.') !== false)
		{
			$file_name = realpath($photo);
			$photo = curl_file_create($file_name);
            $response = true;
		}
	}
	$args = [
		'chat_id' => $chat_id,
		'photo' => $photo
		];
	if(isset($caption))
	{
		$args['caption'] = $caption;
	}
	if(isset($parse_mode))
    	{
        $args['parse_mode'] = $parse_mode;
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

    if($response)
    {
        return curlRequest('sendPhoto', $args);
    }
    else
    {
        return jsonPayload('sendPhoto', $args);
    }
}


function sendAudio($chat_id, $audio, $caption = NULL, $parse_mode = NULL, $duration = NULL, $performer = NULL, $title = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
	if(stripos($audio, 'http') === false)
	{
		if(stripos($audio, '.') !== false)
		{
			$file_name = realpath($audio);
			$audio = curl_file_create($file_name);
            $response = true;
		}
	}
	$args = [
		'chat_id' => $chat_id,
		'audio' => $audio
		];
	if(isset($caption))
	{
		$args['caption'] = $caption;
	}
    if(isset($parse_mode))
    {
        $args['parse_mode'] = $parse_mode;
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

    if($response)
    {
        return curlRequest('sendAudio', $args);
    }
    else
    {
        return jsonPayload('sendAudio', $args);
    }
}


function sendDocument($chat_id, $document, $caption = NULL, $parse_mode = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
    if (stripos($document, 'http') === false) {
        if (stripos($document, '.') !== false) {
            $file_name = realpath($document);
            $document = curl_file_create($file_name);
            $response = true;
        }
    }
    $args = [
        'chat_id' => $chat_id,
        'document' => $document
    ];
    if (isset($caption))
    {
        $args['caption'] = $caption;
    }
    if(isset($parse_mode))
    {
        $args['parse_mode'] = $parse_mode;
    }
    if (isset($disable_notification))
    {
        $args['disable_notification'] = $disable_notification;
    }
    if (isset($reply_to_message_id))
    {
        $args['reply_to_message_id'] = $reply_to_message_id;
    }
    if (isset($reply_markup))
    {
        $reply_markup = json_encode($reply_markup);
        $args['reply_markup'] = $reply_markup;
    }

    if ($response == true)
    {
        return curlRequest('sendDocument', $args);
    }
    else
    {
        return jsonPayload('sendDocument', $args);
    }
}


function sendVideo($chat_id, $video, $duration = NULL, $width = NULL, $height = NULL, $caption = NULL, $parse_mode = NULL, $supports_streaming = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
    if (stripos($video, 'http') === false)
    {
        if (stripos($video, '.') !== false)
        {
            $file_name = realpath($video);
            $video = curl_file_create($file_name);
            $response = true;
        }
    }
    $args = [
        'chat_id' => $chat_id,
        'video' => $video
    ];
    if (isset($duration))
    {
        $args['duration'] = $duration;
    }
    if (isset($width))
    {
        $args['width'] = $width;
    }
    if (isset($height))
    {
        $args['height'] = $height;
    }
    if (isset($caption))
    {
        $args['caption'] = $caption;
    }
    if (isset($parse_mode))
    {
        $args['parse_mode'] = $parse_mode;
    }
    if (isset($supports_streaming))
    {
        $args['supports_streaming'] = $supports_streaming;
    }
    if (isset($disable_notification))
    {
        $args['disable_notification'] = $disable_notification;
    }
    if (isset($reply_to_message_id))
    {
        $args['reply_to_message_id'] = $reply_to_message_id;
    }
    if (isset($reply_markup))
    {
        $reply_markup = json_encode($reply_markup);
        $args['reply_markup'] = $reply_markup;
    }

    if ($response == true)
    {
        return curlRequest('sendVideo', $args);
    }
    else
    {
        return jsonPayload('sendVideo', $args);
    }
}

function sendVoice($chat_id, $voice, $caption = NULL, $parse_mode = NULL, $duration = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
	if(stripos($voice, 'http') === false)
	{
		if(stripos($voice, '.') !== false)
		{
			$file_name = realpath($voice);
			$voice = curl_file_create($file_name);
            $response = true;
		}
	}
	$args = [
		'chat_id' => $chat_id,
		'voice' => $voice
		];
	if(isset($caption))
	{
		$args['caption'] = $caption;
	}
    if(isset($parse_mode))
    {
        $args['parse_mode'] = $parse_mode;
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

    if($response)
    {
        return curlRequest('sendVoice', $args);
    }
    else
    {
        return jsonPayload('sendVoice', $args);
    }
}

//Sending video notes by a URL is currently unsupported by Telegram (Bot Api 3.4) https://core.telegram.org/bots/api#sendvideonote
function sendVideoNote($chat_id, $video_note, $duration = NULL, $length = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
	if(stripos($video_note, 'http') === false)
	{
		if(stripos($video_note, '.') !== false)
		{
			$file_name = realpath($video_note);
			$video_note = curl_file_create($file_name);
            $response = true;
		}
	}
	$args = [
		'chat_id' => $chat_id,
		'video_note' => $video_note
		];
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

    if($response)
    {
        return curlRequest('sendVideoNote', $args);
    }
    else
    {
        return jsonPayload('sendVideoNote', $args);
    }
}


//in $media send an associative array with type and id/link/path. Exaple: $media = [['type' => 'photo', 'media' => '1234'], ['type' => 'video', 'media' => 'https://site/video.mp4']] https://core.telegram.org/bots/api#inputmedia
function sendMediaGroup($chat_id, $media, $disable_notification = NULL, $reply_to_message_id = NULL)
{	
	$media = json_encode($media);
	$args = [
		'chat_id' => $chat_id,
		'media' => $media
		];
	if(isset($disable_notification))
	{
		$args['disable_notification'] = $disable_notification;
	}
	if(isset($reply_to_message_id))
	{
		$args['reply_to_message_id'] = $reply_to_message_id;
	}

    return curlRequest('sendMediaGroup', $args);
}


function sendContact($chat_id, $phone_number, $first_name, $last_name, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
	$args = [
		'chat_id' => $chat_id,
		'phone_number' => $phone_number,
		'first_name' => $first_name
		];
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

    if($response)
    {
        return curlRequest('sendContact', $args);
    }
    else
    {
        return jsonPayload('sendContact', $args);
    }
}
