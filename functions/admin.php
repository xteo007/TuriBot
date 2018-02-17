<?php


function kickChatMember($chat_id, $user_id, $until_date = NULL, $response = false)
{
	$args = [
		'chat_id' => $chat_id,
		'user_id' => $user_id
		];
	if(isset($until_date))
	{
		$args['until_date'] = $until_date;
	}

    if($response)
    {
        return curlRequest('kickChatMember', $args);
    }
    else
    {
        return jsonPayload('kickChatMember', $args);
    }
}


function unbanChatMember($chat_id, $user_id, $response = false)
{
	$args = [
		'chat_id' => $chat_id,
		'user_id' => $user_id
		];

    if($response)
    {
        return curlRequest('unbanChatMember', $args);
    }
    else
    {
        return jsonPayload('unbanChatMember', $args);
    }
}


function restrictChatMember($chat_id, $user_id, $until_date = NULL, $can_send_messages = NULL, $can_send_media_messages = NULL, $can_send_other_messages = NULL, $can_add_web_page_previews = NULL, $response = false)
{
	$args = [
		'chat_id' => $chat_id,
		'user_id' => $user_id
		];
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

    if($response)
    {
        return curlRequest('restrictChatMember', $args);
    }
    else
    {
        return jsonPayload('restrictChatMember', $args);
    }
}


function promoteChatMember($chat_id, $user_id, $can_change_info = NULL, $can_post_messages = NULL, $can_edit_messages = NULL, $can_delete_messages = NULL, $can_invite_users = NULL, $can_restrict_members = NULL, $can_pin_messages = NULL, $can_promote_members = NULL, $response = false)
{
	$args = [
		'chat_id' => $chat_id,
		'user_id' => $user_id
		];
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

    if($response)
    {
        return curlRequest('promoteChatMember', $args);
    }
    else
    {
        return jsonPayload('promoteChatMember', $args);
    }
}


function exportChatInviteLink($chat_id)
{
	$args = [
		'chat_id' => $chat_id
		];

    return curlRequest('exportChatInviteLink', $args);
}


function setChatPhoto($chat_id, $photo)
{
    $file_name = realpath($photo);
    $photo = curl_file_create($file_name);
    $args = [
        'chat_id' => $chat_id,
        'photo' => $photo
    ];

    return curlRequest('setChatPhoto', $args);
}


function deleteChatPhoto($chat_id, $response = false)
{
	$args = [
		'chat_id' => $chat_id
		];

    if($response)
    {
        return curlRequest('deleteChatPhoto', $args);
    }
    else
    {
        return jsonPayload('deleteChatPhoto', $args);
    }
}


function setChatTitle($chat_id, $title, $response = false)
{
	$args = [
		'chat_id' => $chat_id,
		'title' => $title
		];

    if($response)
    {
        return curlRequest('setChatTitle', $args);
    }
    else
    {
        return jsonPayload('setChatTitle', $args);
    }
}


function setChatDescription($chat_id, $description = NULL, $response = false)
{
	$args = [
		'chat_id' => $chat_id
		];
	if(isset($description))
	{
		$args['description'] = $description;
	}

    if($response)
    {
        return curlRequest('setChatDescription', $args);
    }
    else
    {
        return jsonPayload('setChatDescription', $args);
    }
}


function pinChatMessage($chat_id, $message_id, $disable_notification = NULL, $response = false)
{
	$args = [
		'chat_id' => $chat_id,
		'message_id' => $message_id
		];
	if(isset($disable_notification))
	{
		$args['disable_notification'] = $disable_notification;
	}

    if($response)
    {
        return curlRequest('pinChatMessage', $args);
    }
    else
    {
        return jsonPayload('pinChatMessage', $args);
    }
}


function unpinChatMessage($chat_id, $response = false)
{
	$args = [
		'chat_id' => $chat_id
		];

    if($response)
    {
        return curlRequest('unpinChatMessage', $args);
    }
    else
    {
        return jsonPayload('unpinChatMessage', $args);
    }
}


function leaveChat($chat_id, $response = false)
{
	$args = [
		'chat_id' => $chat_id
		];

    if($response)
    {
        return curlRequest('leaveChat', $args);
    }
    else
    {
        return jsonPayload('leaveChat', $args);
    }
}


function getChatAdministrators($chat_id)
{
	$args = [
		'chat_id' => $chat_id
		];

    return curlRequest('getChatAdministrators', $args);
}


function getChatMembersCount($chat_id)
{
	$args = [
		'chat_id' => $chat_id
		];

    return curlRequest('getChatMembersCount', $args);
}


function getChatMember($chat_id, $user_id)
{
	$args = [
		'chat_id' => $chat_id,
		'user_id' => $user_id
		];

    return curlRequest('getChatMember', $args);
}
