<?php


function kickChatMember($chat_id, $user_id, $until_date = NULL)
{
	$args = array(
		'chat_id' => $chat_id,
		'user_id' => $user_id
		);
	if(isset($until_date))
	{
		$args['until_date'] = $until_date;
	}
	$rr = curlRequest("kickChatMember", $args);
	return $rr;
}


function unbanChatMember($chat_id, $user_id)
{
	$args = array(
		'chat_id' => $chat_id,
		'user_id' => $user_id
		);
	$rr = curlRequest("unbanChatMember", $args);
	return $rr;
}


function restrictChatMember($chat_id, $user_id, $until_date = NULL, $can_send_messages = NULL, $can_send_media_messages = NULL, $can_send_other_messages = NULL, $can_add_web_page_previews = NULL)
{
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
	$rr = curlRequest("restrictChatMember", $args);
	return $rr;
}


function promoteChatMember($chat_id, $user_id, $can_change_info = NULL, $can_post_messages = NULL, $can_edit_messages = NULL, $can_delete_messages = NULL, $can_invite_users = NULL, $can_restrict_members = NULL, $can_pin_messages = NULL, $can_promote_members = NULL)
{
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
	$rr = curlRequest("promoteChatMember", $args);
	return $rr;
}


function exportChatInviteLink($chat_id)
{
	$args = array(
		'chat_id' => $chat_id
		);
	$rr = curlRequest("exportChatInviteLink", $args);
	return $rr;
}


function setChatPhoto($chat_id, $photo)
{
	$file_name = realpath($photo);
	$photo = curl_file_create($file_name);
	$args = array(
		'chat_id' => $chat_id,
		'photo' => $photo
		);
	$rr = curlRequest("setChatPhoto", $args);
	return $rr;
}


function deleteChatPhoto($chat_id)
{
	$args = array(
		'chat_id' => $chat_id
		);
	$rr = curlRequest("deleteChatPhoto", $args);
	return $rr;
}


function setChatTitle($chat_id, $title)
{
	$args = array(
		'chat_id' => $chat_id,
		'title' => $title
		);
	$rr = curlRequest("setChatTitle", $args);
	return $rr;
}


function setChatDescription($chat_id, $description = NULL)
{
	$args = array(
		'chat_id' => $chat_id
		);
	if(isset($description))
	{
		$args['description'] = $description;
	}
	$rr = curlRequest("setChatDescription", $args);
	return $rr;
}


function pinChatMessage($chat_id, $message_id, $disable_notification = NULL)
{
	$args = array(
		'chat_id' => $chat_id,
		'message_id' => $message_id
		);
	if(isset($disable_notification))
	{
		$args['disable_notification'] = $disable_notification;
	}
	$rr = curlRequest("pinChatMessage", $args);
	return $rr;
}


function unpinChatMessage($chat_id)
{
	$args = array(
		'chat_id' => $chat_id
		);
	$rr = curlRequest("unpinChatMessage", $args);
	return $rr;
}


function leaveChat($chat_id)
{
	$args = array(
		'chat_id' => $chat_id
		);
	$rr = curlRequest("leaveChat", $args);
	return $rr;
}


function getChatAdministrators($chat_id)
{
	$args = array(
		'chat_id' => $chat_id
		);
	$rr = curlRequest("getChatAdministrators", $args);
	return $rr;
}


function getChatMembersCount($chat_id)
{
	$args = array(
		'chat_id' => $chat_id
		);
	$rr = curlRequest("getChatMembersCount", $args);
	return $rr;
}


function getChatMember($chat_id, $user_id)
{
	$args = array(
		'chat_id' => $chat_id,
		'user_id' => $user_id
		);
	$rr = curlRequest("getChatMember", $args);
	return $rr;
}
