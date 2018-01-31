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
        $rr = curlRequest("kickChatMember", $args);
    }
    else
    {
        jsonPayload("kickChatMember", $args);
        $rr = true;
    }

    return $rr;
}


function unbanChatMember($chat_id, $user_id, $response = false)
{
	$args = [
		'chat_id' => $chat_id,
		'user_id' => $user_id
		];

    if($response)
    {
        $rr = curlRequest("unbanChatMember", $args);
    }
    else
    {
        jsonPayload("unbanChatMember", $args);
        $rr = true;
    }

    return $rr;
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
        $rr = curlRequest("restrictChatMember", $args);
    }
    else
    {
        jsonPayload("restrictChatMember", $args);
        $rr = true;
    }

    return $rr;
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
        $rr = curlRequest("promoteChatMember", $args);
    }
    else
    {
        jsonPayload("promoteChatMember", $args);
        $rr = true;
    }

    return $rr;
}


function exportChatInviteLink($chat_id)
{
	$args = [
		'chat_id' => $chat_id
		];

    $rr = curlRequest("exportChatInviteLink", $args);
    return $rr;
}


function setChatPhoto($chat_id, $photo)
{
    $file_name = realpath($photo);
    $photo = curl_file_create($file_name);
    $args = [
        'chat_id' => $chat_id,
        'photo' => $photo
    ];

    $rr = curlRequest("setChatPhoto", $args);
    return $rr;
}


function deleteChatPhoto($chat_id, $response = false)
{
	$args = [
		'chat_id' => $chat_id
		];

    if($response)
    {
        $rr = curlRequest("deleteChatPhoto", $args);
    }
    else
    {
        jsonPayload("deleteChatPhoto", $args);
        $rr = true;
    }

    return $rr;
}


function setChatTitle($chat_id, $title, $response = false)
{
	$args = [
		'chat_id' => $chat_id,
		'title' => $title
		];

    if($response)
    {
        $rr = curlRequest("setChatTitle", $args);
    }
    else
    {
        jsonPayload("setChatTitle", $args);
        $rr = true;
    }

    return $rr;
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
        $rr = curlRequest("setChatDescription", $args);
    }
    else
    {
        jsonPayload("setChatDescription", $args);
        $rr = true;
    }

    return $rr;
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
        $rr = curlRequest("pinChatMessage", $args);
    }
    else
    {
        jsonPayload("pinChatMessage", $args);
        $rr = true;
    }

    return $rr;
}


function unpinChatMessage($chat_id, $response = false)
{
	$args = [
		'chat_id' => $chat_id
		];

    if($response)
    {
        $rr = curlRequest("unpinChatMessage", $args);
    }
    else
    {
        jsonPayload("unpinChatMessage", $args);
        $rr = true;
    }

    return $rr;
}


function leaveChat($chat_id, $response = false)
{
	$args = [
		'chat_id' => $chat_id
		];

    if($response)
    {
        $rr = curlRequest("leaveChat", $args);
    }
    else
    {
        jsonPayload("leaveChat", $args);
        $rr = true;
    }

    return $rr;
}


function getChatAdministrators($chat_id)
{
	$args = [
		'chat_id' => $chat_id
		];

    $rr = curlRequest("getChatAdministrators", $args);
    return $rr;
}


function getChatMembersCount($chat_id)
{
	$args = [
		'chat_id' => $chat_id
		];

    $rr = curlRequest("getChatMembersCount", $args);
    return $rr;
}


function getChatMember($chat_id, $user_id)
{
	$args = [
		'chat_id' => $chat_id,
		'user_id' => $user_id
		];

    $rr = curlRequest("getChatMember", $args);
    return $rr;
}
