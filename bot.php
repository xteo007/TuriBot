<?

/**
*    Copyright (C) 2017  Davide Turaccio
*
*    This program is free software: you can redistribute it and/or modify
*    it under the terms of the GNU Affero General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    This program is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
**/


//$api is a global variable in many function!
if(isset($_GET['api']))
{
$api = $_GET['api'];
}
else
{
//enter here your api id obtained with @BotFather or use setup.php
$api = "123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11";
}


//receiving updates via the webhook
$content = file_get_contents("php://input");
$update = json_decode($content, true);


//all variables are created automatically without the need of $update['message']['text']; (you can simply use $message_text)
//variables are created using the available telegram types fields https://core.telegram.org/bots/api#available-types
//to get all the names of the variables just go to this link https://core.telegram.org/bots/api#update and go to see the various types below
//For example, the update object https://core.telegram.org/bots/api#update has "edited_message" (if there is no edited message in the update received from the telegram the variable will not exist) to read the contents of the text will just go to see the type used for edited_message that corresponds to "message" https://core.telegram.org/bots/api#message, if you want to read the message text just use $message_text ("message" + _ + "text")

//scan update
foreach($update as $update_key => $update_val)
{
	//$$ is a variable variable http://php.net/manual/en/language.variables.variable.php
	$$update_key = $update_val;
	//scan field of update (message/edited_message/channel_post/edited_channel_post...)
	foreach($$update_key as $update_field_key => $update_field_val)
	{
		$update_field_key = $update_key . "_" . $update_field_key;
		$$update_field_key = $update_field_val;
		//scan field of update of message/edited_message/channel_post/edited_channel_post... (message_id,from,date,chat...) https://core.telegram.org/bots/api#update
		foreach($$update_field_key as $update_scan_key => $update_scan_val)
		{
			$update_scan_key = $update_field_key . "_" . $update_scan_key;
			$$update_scan_key = $update_scan_val;
			//scan field of update of message/edited_message/channel_post/edited_channel_post... of from,chat,forward_from,forward_from_chat...
			foreach($$update_scan_key as $update_scan2_key => $update_scan2_val)
			{
				$update_scan2_key = $update_scan_key . "_" . $update_scan2_key;
				$$update_scan2_key = $update_scan2_val;
				//another scan
				foreach($$update_scan2_key as $update_scan3_key => $update_scan3_val)
				{
					$update_scan3_key = $update_scan2_key . "_" . $update_scan3_key;
					$$update_scan3_key = $update_scan3_val;
					//another scan
					foreach($$update_scan2_key as $update_scan3_key => $update_scan3_val)
					{
						$update_scan3_key = $update_scan2_key . "_" . $update_scan3_key;
						$$update_scan3_key = $update_scan3_val;
						foreach($$update_scan3_key as $update_scan4_key => $update_scan4_val)
						{
							$$update_scan4_key = $update_scan4_val;
						}
					}					
				}
			}
		}
	}
}




function getUpdates($offset, $limit = NULL, $timeout = NULL, $allowed_updates = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n"));
	$context = stream_context_create($options);
	if(isset($offset))
	{
		$args['offset'] = $offset;
	}
	if(isset($limit))
	{
		$args['limit'] = $limit;
	}
	if(isset($timeout))
	{
		$args['timeout'] = $timeout;
	}
	if(isset($allowed_updates))
	{
		$args['allowed_updates'] = $allowed_updates;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/getUpdates?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function setWebhook($url, $certificate = NULL, $max_connections = NULL, $allowed_updates = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n"));
	$context = stream_context_create($options);
	$file_name = realpath($certificate);
	$certificate = curl_file_create($file_name);
	$args = array(
		'url' => $url
		);
	if(isset($certificate))
	{
		$args['certificate'] = $certificate;
	}
	if(isset($max_connections))
	{
		$args['max_connections'] = $max_connections;
	}
	if(isset($allowed_updates))
	{
		$args['allowed_updates'] = $allowed_updates;
	}
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$api/setWebhook");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$rr = curl_exec($ch);
	curl_close($ch);
	return $rr;
}


function deleteWebhook()
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n"));
	$context = stream_context_create($options);
	$r = file_get_contents("https://api.telegram.org/bot$api/deleteWebhook", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


//test if the bot works
//returns an array with the telegram response
//optional parameter to print on screen if bot works
function getMe($verbose = false)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$r = file_get_contents("https://api.telegram.org/bot$api/getMe", false, $context);
	$rr = json_decode($r, true);

	if($verbose)
	{
		if($rr['ok'])
		{
			$bot = $rr['result']['username'];
			echo "Bot: @" . $bot;
		}
		else
		{
			echo "API ID wrong or impossible to connect to Telegram";
		}
	}
	return $rr;
}


function sendMessage($chat_id, $text, $parse_mode = NULL, $disable_web_page_preview = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'text' => $text
		);
	if(isset($parse_mode))
	{
		$args['parse_mode'] = $parse_mode;
	}
	if(isset($disable_web_page_preview))
	{
		$args['disable_web_page_preview'] = $disable_web_page_preview;
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
	$params = http_build_query($args);
	$r = @file_get_contents("https://api.telegram.org/bot$api/sendMessage?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function forwardMessage($chat_id, $from_chat_id, $message_id, $disable_notification = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'from_chat_id' => $from_chat_id,
		'message_id' => $message_id
		);
	if(isset($disable_notification))
	{
		$args['disable_notification'] = $disable_notification;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/forwardMessage?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}

//$photo = file_id or http url or file
//example = "11111111" or "http://your_website.com/photo.jpg" or "photo.jpg" (in same directory)
function sendPhoto($chat_id, $photo, $caption = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$file = false;
	if(stripos($photo, "http") === false)
	{
		if(stripos($photo, ".") !== false)
		{
			$file = true;
			$file_name = realpath($photo);
			$photo = curl_file_create($file_name);
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
	if(!$file)
	{
		$params = http_build_query($args);
		$r = file_get_contents("https://api.telegram.org/bot$api/sendPhoto?$params", false, $context);
		$rr = json_decode($r, true);
	}
	else
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$api/sendPhoto");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$rr = curl_exec($ch);
		curl_close($ch);
	}
	return $rr;	
}


function sendAudio($chat_id, $audio, $caption = NULL, $duration = NULL, $performer = NULL, $title = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$file = false;
	if(stripos($audio, "http") === false)
	{
		if(stripos($audio, ".") !== false)
		{
			$file = true;
			$file_name = realpath($audio);
			$audio = curl_file_create($file_name);
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
	if(!$file)
	{
		$params = http_build_query($args);
		$r = file_get_contents("https://api.telegram.org/bot$api/sendAudio?$params", false, $context);
		$rr = json_decode($r, true);
	}
	else
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$api/sendAudio");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$rr = curl_exec($ch);
		curl_close($ch);
	}
	return $rr;	
}


function sendDocument($chat_id, $document, $caption = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$file = false;
	if(stripos($document, "http") === false)
	{
		if(stripos($document, ".") !== false)
		{
			$file = true;
			$file_name = realpath($document);
			$document = curl_file_create($file_name);
		}
	}
	$args = array(
		'chat_id' => $chat_id,
		'document' => $document
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
	if(!$file)
	{
		$params = http_build_query($args);
		$r = file_get_contents("https://api.telegram.org/bot$api/sendDocument?$params", false, $context);
		$rr = json_decode($r, true);
	}
	else
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$api/sendDocument");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$rr = curl_exec($ch);
		curl_close($ch);
	}
	return $rr;	
}


function sendVideo($chat_id, $video, $duration = NULL, $width = NULL, $height = NULL, $caption = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$file = false;
	if(stripos($video, "http") === false)
	{
		if(stripos($video, ".") !== false)
		{
			$file = true;
			$file_name = realpath($video);
			$video = curl_file_create($file_name);
		}
	}
	$args = array(
		'chat_id' => $chat_id,
		'video' => $video
		);
	if(isset($duration))
	{
		$args['duration'] = $duration;
	}
	if(isset($width))
	{
		$args['width'] = $width;
	}
	if(isset($height))
	{
		$args['height'] = $height;
	}
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
	if(!$file)
	{
		$params = http_build_query($args);
		$r = file_get_contents("https://api.telegram.org/bot$api/sendVideo?$params", false, $context);
		$rr = json_decode($r, true);
	}
	else
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$api/sendVideo");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$rr = curl_exec($ch);
		curl_close($ch);
	}
	return $rr;	
}


function sendVoice($chat_id, $voice, $caption = NULL, $duration = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$file = false;
	if(stripos($voice, "http") === false)
	{
		if(stripos($voice, ".") !== false)
		{
			$file = true;
			$file_name = realpath($voice);
			$voice = curl_file_create($file_name);
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
	if(!$file)
	{
		$params = http_build_query($args);
		$r = file_get_contents("https://api.telegram.org/bot$api/sendVoice?$params", false, $context);
		$rr = json_decode($r, true);
	}
	else
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$api/sendVoice");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$rr = curl_exec($ch);
		curl_close($ch);
	}
	return $rr;	
}

//Sending video notes by a URL is currently unsupported by Telegram (Bot Api 3.4) https://core.telegram.org/bots/api#sendvideonote
function sendVideoNote($chat_id, $video_note, $duration = NULL, $length = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$file = false;
	if(stripos($video_note, "http") === false)
	{
		if(stripos($video_note, ".") !== false)
		{
			$file = true;
			$file_name = realpath($video_note);
			$video_note = curl_file_create($file_name);
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
	if(!$file)
	{
		$params = http_build_query($args);
		$r = file_get_contents("https://api.telegram.org/bot$api/sendVideoNote?$params", false, $context);
		$rr = json_decode($r, true);
	}
	else
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$api/sendVideoNote");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$rr = curl_exec($ch);
		curl_close($ch);
	}
	return $rr;	
}


function sendLocation($chat_id, $latitude, $longitude, $live_period = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'latitude' => $latitude,
		'longitude' => $longitude
		);
	if(isset($live_period))
	{
		$args['live_period'] = $live_period;
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
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/sendLocation?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;	
}


function editMessageLiveLocation($latitude, $longitude, $chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'latitude' => $latitude,
		'longitude' => $longitude
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
	if(isset($reply_markup))
	{
		$reply_markup = json_encode($reply_markup);
		$args['reply_markup'] = $reply_markup;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/editMessageLiveLocation?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;	
}


function stopMessageLiveLocation($chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
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
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/stopMessageLiveLocation?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;	
}


function sendVenue($chat_id, $latitude, $longitude, $title, $address, $foursquare_id = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'latitude' => $latitude,
		'longitude' => $longitude,
		'title' => $title,
		'address' => $address
		);
	if(isset($foursquare_id))
	{
		$args['foursquare_id'] = $foursquare_id;
	}
	if(isset($message_id))
	{
		$args['message_id'] = $message_id;
	}
	if(isset($inline_message_id))
	{
		$args['inline_message_id'] = $inline_message_id;
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
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/sendVenue?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;	
}


function sendContact($chat_id, $phone_number, $first_name, $last_name, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
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
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/sendContact?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;	
}


function sendChatAction($chat_id, $action)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'action' => $action
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/sendChatAction?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;	
}


function getUserProfilePhotos($user_id, $offset = NULL, $limit = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'user_id' => $user_id
		);
	if(isset($offset))
	{
		$args['offset'] = $offset;
	}
	if(isset($limit))
	{
		$args['limit'] = $limit;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/getUserProfilePhotos?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}

//$info = getFile("11111111"); $file_path = $info['file_path']; $download link = "https://api.telegram.org/file/bot$info/$file_path" //max 20MB https://core.telegram.org/bots/api#getfile
function getFile($file_id)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'file_id' => $file_id
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/getFile?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function kickChatMember($chat_id, $user_id, $until_date = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'user_id' => $user_id
		);
	if(isset($until_date))
	{
		$args['until_date'] = $until_date;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/kickChatMember?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function unbanChatMember($chat_id, $user_id)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'user_id' => $user_id
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/unbanChatMember?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function restrictChatMember($chat_id, $user_id, $until_date = NULL, $can_send_messages = NULL, $can_send_media_messages = NULL, $can_send_other_messages = NULL, $can_add_web_page_previews = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'user_id' => $user_id
		);
	if(isset($until_date))
	{
		$args['until_date'] = $until_date;
	}
	if(isset($can_send_messages))
	{
		$args['can_send_messages'] = $can_send_messages;
	}
	if(isset($can_send_media_messages))
	{
		$args['can_send_media_messages'] = $can_send_media_messages;
	}
	if(isset($can_send_other_messages))
	{
		$args['can_send_other_messages'] = $can_send_other_messages;
	}
	if(isset($can_add_web_page_previews))
	{
		$args['can_add_web_page_previews'] = $can_add_web_page_previews;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/restrictChatMember?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function promoteChatMember($chat_id, $user_id, $can_change_info = NULL, $can_post_messages = NULL, $can_edit_messages = NULL, $can_delete_messages = NULL, $can_invite_users = NULL, $can_restrict_members = NULL, $can_pin_messages = NULL, $can_promote_members = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'user_id' => $user_id
		);
	if(isset($can_change_info))
	{
		$args['can_change_info'] = $can_change_info;
	}
	if(isset($can_post_messages))
	{
		$args['can_post_messages'] = $can_post_messages;
	}
	if(isset($can_edit_messages))
	{
		$args['can_edit_messages'] = $can_edit_messages;
	}
	if(isset($can_delete_messages))
	{
		$args['can_delete_messages'] = $can_delete_messages;
	}
	if(isset($can_invite_users))
	{
		$args['can_invite_users'] = $can_invite_users;
	}
	if(isset($can_restrict_members))
	{
		$args['can_restrict_members'] = $can_restrict_members;
	}
	if(isset($can_pin_messages))
	{
		$args['can_pin_messages'] = $can_pin_messages;
	}
	if(isset($can_promote_members))
	{
		$args['can_promote_members'] = $can_promote_members;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/promoteChatMember?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function exportChatInviteLink($chat_id)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/exportChatInviteLink?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function setChatPhoto($chat_id, $photo)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$file_name = realpath($photo);
	$photo = curl_file_create($file_name);
	$args = array(
		'chat_id' => $chat_id,
		'photo' => $photo
		);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$api/setChatPhoto");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$rr = curl_exec($ch);
	curl_close($ch);
	return $rr;
}


function deleteChatPhoto($chat_id)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/deleteChatPhoto?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function setChatTitle($chat_id, $title)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'title' => $title
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/setChatTitle?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function setChatDescription($chat_id, $description = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id
		);
	if(isset($description))
	{
		$args['description'] = $description;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/setChatDescription?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function pinChatMessage($chat_id, $message_id, $disable_notification = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'message_id' => $message_id
		);
	if(isset($disable_notification))
	{
		$args['disable_notification'] = $disable_notification;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/pinChatMessage?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function unpinChatMessage($chat_id)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/unpinChatMessage?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function leaveChat($chat_id)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/leaveChat?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function getChat($chat_id)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/getChat?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function getChatAdministrators($chat_id)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/getChatAdministrators?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function getChatMembersCount($chat_id)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/getChatMembersCount?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function getChatMember($chat_id, $user_id)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'user_id' => $user_id
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/getChatMember?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


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


function answerCallbackQuery($callback_query_id, $text = NULL, $show_alert = NULL, $url = NULL, $cache_time = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'callback_query_id' => $callback_query_id
		);
	if(isset($text))
	{
		$args['text'] = $text;
	}
	if(isset($show_alert))
	{
		$args['show_alert'] = $show_alert;
	}
	if(isset($url))
	{
		$args['url'] = $url;
	}
	if(isset($cache_time))
	{
		$args['cache_time'] = $cache_time;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/answerCallbackQuery?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


//updating messages
function editMessageText($text, $chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $parse_mode = NULL, $disable_web_page_preview = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
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
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/editMessageText?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function editMessageCaption($chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $caption = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
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
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/editMessageCaption?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function editMessageReplyMarkup($chat_id = NULL, $message_id = NULL, $inline_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
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
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/editMessageReplyMarkup?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function deleteMessage($chat_id, $message_id)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'message_id' => $message_id,
		);
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/deleteMessage?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


//inline mode
function answerInlineQuery($inline_query_id, $results, $cache_time = NULL, $is_personal = NULL, $next_offset = NULL, $switch_pm_text = NULL, $switch_pm_parameter = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$results = json_encode($results);
	$args = array(
		'inline_query_id' => $inline_query_id,
		'results' => $results
		);
	if(isset($cache_time))
	{
		$args['cache_time'] = $cache_time;
	}
	if(isset($is_personal))
	{
		$args['is_personal'] = $is_personal;
	}
	if(isset($next_offset))
	{
		$args['next_offset'] = $next_offset;
	}
	if(isset($switch_pm_text))
	{
		$args['switch_pm_text'] = $switch_pm_text;
	}
	if(isset($switch_pm_parameter))
	{
		$args['switch_pm_parameter'] = $switch_pm_parameter;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/answerInlineQuery?$params", false, $context);
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
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$api/sendSticker");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$rr = curl_exec($ch);
		curl_close($ch);
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
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$api/uploadStickerFile");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$rr = curl_exec($ch);
	curl_close($ch);
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
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$api/createNewStickerSet");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$rr = curl_exec($ch);
		curl_close($ch);
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
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$api/addStickerToSet");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$rr = curl_exec($ch);
		curl_close($ch);
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


//payments
function sendInvoice($chat_id, $title, $description, $payload, $provider_token, $start_parameter, $currency, $prices, $photo_url = NULL, $photo_size = NULL, $photo_width = NULL, $photo_height = NULL, $need_name = NULL, $need_phone_number = NULL, $need_email = NULL, $need_shipping_address = NULL, $is_flexible = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'title' => $title,
		'description' => $description,
		'payload' => $payload,
		'provider_token' => $provider_token,
		'start_parameter' => $start_parameter,
		'currency' => $currency,
		'prices' => $prices
		);
	if(isset($photo_url))
	{
		$args['photo_url'] = $photo_url;
	}
	if(isset($photo_size))
	{
		$args['photo_size'] = $photo_size;
	}
	if(isset($photo_width))
	{
		$args['photo_width'] = $photo_width;
	}
	if(isset($photo_height))
	{
		$args['photo_height'] = $photo_height;
	}
	if(isset($need_name))
	{
		$args['need_name'] = $need_name;
	}
	if(isset($need_phone_number))
	{
		$args['need_phone_number'] = $need_phone_number;
	}
	if(isset($need_email))
	{
		$args['need_email'] = $need_email;
	}
	if(isset($need_shipping_address))
	{
		$args['need_shipping_address'] = $need_shipping_address;
	}
	if(isset($is_flexible))
	{
		$args['is_flexible'] = $is_flexible;
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
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/sendInvoice?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function answerShippingQuery($shipping_query_id, $ok, $shipping_options = NULL, $error_message = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'shipping_query_id' => $shipping_query_id,
		'ok' => $ok
		);
	if(isset($shipping_options))
	{
		$shipping_options = json_encode($shipping_options);
		$args['shipping_options'] = $shipping_options;
	}
	if(isset($error_message))
	{
		$args['error_message'] = $error_message;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/answerShippingQuery?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function answerPreCheckoutQuery($pre_checkout_query_id, $ok, $error_message = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'pre_checkout_query_id' => $pre_checkout_query_id,
		'ok' => $ok
		);
	if(isset($error_message))
	{
		$args['error_message'] = $error_message;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/answerPreCheckoutQuery?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


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
