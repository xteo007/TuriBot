<?php

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


//$api is a global variable in curlRequest function!
if(isset($_GET['api']))
{
$api = $_GET['api'];
}
else
{
//enter here your api id obtained with @BotFather and manually set the webhook or use setup.php
$api = "123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11";
}


//receiving updates via the webhook
$content = file_get_contents("php://input");
$update = json_decode($content, true);


//All variables are created automatically without the need of $update['message']['text']; (you can simply use $message_text)
//Variables are created using the available telegram types fields https://core.telegram.org/bots/api#available-types
//To get a list of all the variables, visit https://core.telegram.org/bots/api#update
//For example, the update object https://core.telegram.org/bots/api#update has "edited_message" (if there is no edited message in the update received from Telegram the variable will not exist) to read the contents of the text you can just have a look at the type used for edited_message that corresponds to "message" https://core.telegram.org/bots/api#message, if you want to read the message text just use $message_text ("message" + _ + "text")

//scan update
foreach($update as $update_key => $update_val)
{
	//$$ is a variable variable http://php.net/manual/en/language.variables.variable.php
	$$update_key = $update_val;
	//scan field of update (message/edited_message/channel_post/edited_channel_post...)
	foreach($$update_key as $update_field_key => $update_field_val)
	{
		//$update_field_key = $update_key . "_" . $update_field_key;
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
				//another scan...
				foreach($$update_scan2_key as $update_scan3_key => $update_scan3_val)
				{
					$update_scan3_key = $update_scan2_key . "_" . $update_scan3_key;
					$$update_scan3_key = $update_scan3_val;
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




function curlRequest($method, $args = NULL)
{
	global $api;
	$c = curl_init();
	curl_setopt($c, CURLOPT_URL, "https://api.telegram.org/bot$api/$method");
	curl_setopt($c, CURLOPT_POST, 1);
	if(isset($args))
	{
		curl_setopt($c, CURLOPT_POSTFIELDS, $args);
	}
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	$r = curl_exec($c);
	curl_close($c);
	$rr = json_decode($r, true);
	return $rr;
}




//base functions
function sendMessage($chat_id, $text, $parse_mode = NULL, $disable_web_page_preview = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
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
	$rr = curlRequest("sendMessage", $args);
	return $rr;
}


function forwardMessage($chat_id, $from_chat_id, $disable_notification = NULL, $message_id)
{
	$args = array(
		'chat_id' => $chat_id,
		'from_chat_id' => $from_chat_id,
		'message_id' => $message_id
		);
	if(isset($disable_notification))
	{
		$args['disable_notification'] = $disable_notification;
	}
	$rr = curlRequest("forwardMessage", $args);
	return $rr;
}


include "functions/media.php";
include "functions/edit.php";
include "functions/admin.php";
include "functions/get_info.php";
include "functions/status.php";
include "functions/location.php";
include "functions/updates.php";
include "functions/inline.php";
include "functions/stickers.php";
include "functions/payments.php";
include "functions/games.php";
