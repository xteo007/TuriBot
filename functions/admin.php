<?php


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
	$rr = curlRequest("sendChatPhoto", $args);
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
