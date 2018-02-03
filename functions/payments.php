<?php


//payments
function sendInvoice($chat_id, $title, $description, $payload, $provider_token, $start_parameter, $currency, $prices, $provider_data, $photo_url = NULL, $photo_size = NULL, $photo_width = NULL, $photo_height = NULL, $need_name = NULL, $need_phone_number = NULL, $need_email = NULL, $need_shipping_address = NULL, $is_flexible = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL, $response = false)
{
	$args = [
		'chat_id' => $chat_id,
		'title' => $title,
		'description' => $description,
		'payload' => $payload,
		'provider_token' => $provider_token,
		'start_parameter' => $start_parameter,
		'currency' => $currency,
		'prices' => $prices
		];
	if(isset($provider_data))
	{
        $provider_data = json_encode($provider_data);
		$args['provider_data'] = $provider_data;
	}
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

    if($response)
    {
        $rr = curlRequest("sendInvoice", $args);
    }
    else
    {
        jsonPayload("sendInvoice", $args);
        $rr = true;
    }

    return $rr;
}


function answerShippingQuery($shipping_query_id, $ok, $shipping_options = NULL, $error_message = NULL, $response = false)
{
	$args = [
		'shipping_query_id' => $shipping_query_id,
		'ok' => $ok
		];
	if(isset($shipping_options))
	{
		$shipping_options = json_encode($shipping_options);
		$args['shipping_options'] = $shipping_options;
	}
	if(isset($error_message))
	{
		$args['error_message'] = $error_message;
	}

    if($response)
    {
        $rr = curlRequest("answerShippingQuery", $args);
    }
    else
    {
        jsonPayload("answerShippingQuery", $args);
        $rr = true;
    }

    return $rr;
}


function answerPreCheckoutQuery($pre_checkout_query_id, $ok, $error_message = NULL, $response = false)
{
	$args = [
		'pre_checkout_query_id' => $pre_checkout_query_id,
		'ok' => $ok
		];
	if(isset($error_message))
	{
		$args['error_message'] = $error_message;
	}

    if($response)
    {
        $rr = curlRequest("answerPreCheckoutQuery", $args);
    }
    else
    {
        jsonPayload("answerPreCheckoutQuery", $args);
        $rr = true;
    }

    return $rr;
}