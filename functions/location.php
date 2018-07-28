<?php


function sendLocation(
    $chat_id,
    $latitude,
    $longitude,
    $live_period = null,
    $disable_notification = null,
    $reply_to_message_id = null,
    $reply_markup = null,
    $response = RESPONSE
) {
    $args = [
        'chat_id'   => $chat_id,
        'latitude'  => $latitude,
        'longitude' => $longitude
    ];
    if (isset($live_period)) {
        $args['live_period'] = $live_period;
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

    if ($response) {
        return curlRequest('sendLocation', $args);
    } else {
        return jsonPayload('sendLocation', $args);
    }
}


function editMessageLiveLocation(
    $latitude,
    $longitude,
    $chat_id = null,
    $message_id = null,
    $inline_message_id = null,
    $reply_markup = null,
    $response = RESPONSE
) {
    $args = [
        'latitude'  => $latitude,
        'longitude' => $longitude
    ];
    if (isset($chat_id)) {
        $args['chat_id'] = $chat_id;
    }
    if (isset($message_id)) {
        $args['message_id'] = $message_id;
    }
    if (isset($inline_message_id)) {
        $args['inline_message_id'] = $inline_message_id;
    }
    if (isset($reply_markup)) {
        $reply_markup = json_encode($reply_markup);
        $args['reply_markup'] = $reply_markup;
    }

    if ($response) {
        return curlRequest('editMessageLiveLocation', $args);
    } else {
        return jsonPayload('editMessageLiveLocation', $args);
    }
}


function stopMessageLiveLocation(
    $chat_id = null,
    $message_id = null,
    $inline_message_id = null,
    $reply_markup = null,
    $response = RESPONSE
) {
    if (isset($chat_id)) {
        $args['chat_id'] = $chat_id;
    }
    if (isset($message_id)) {
        $args['message_id'] = $message_id;
    }
    if (isset($inline_message_id)) {
        $args['inline_message_id'] = $inline_message_id;
    }
    if (isset($reply_markup)) {
        $reply_markup = json_encode($reply_markup);
        $args['reply_markup'] = $reply_markup;
    }

    if ($response) {
        if (isset($args)) {
            return curlRequest('stopMessageLiveLocation', $args);
        } else {
            return curlRequest('stopMessageLiveLocation');
        }
    } else {
        if (isset($args)) {
            return jsonPayload('stopMessageLiveLocation', $args);
        } else {
            return jsonPayload('stopMessageLiveLocation');
        }
    }
}


function sendVenue(
    $chat_id,
    $latitude,
    $longitude,
    $title,
    $address,
    $foursquare_id = null,
    $foursquare_type = null,
    $disable_notification = null,
    $reply_to_message_id = null,
    $reply_markup = null,
    $foursquare_type = null,
    $response = RESPONSE
) {
    $args = [
        'chat_id'   => $chat_id,
        'latitude'  => $latitude,
        'longitude' => $longitude,
        'title'     => $title,
        'address'   => $address
    ];
    if (isset($foursquare_id)) {
        $args['foursquare_id'] = $foursquare_id;
    }
    if (isset($foursquare_type)) {
        $args['foursquare_type'] = $foursquare_type;
    }
    if (isset($message_id)) {
        $args['message_id'] = $message_id;
    }
    if (isset($inline_message_id)) {
        $args['inline_message_id'] = $inline_message_id;
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
    if (isset($foursquare_type)) {
        $args['foursquare_type'] = $foursquare_type;
    }

    if ($response) {
        return curlRequest('sendVenue', $args);
    } else {
        return jsonPayload('sendVenue', $args);
    }
}
