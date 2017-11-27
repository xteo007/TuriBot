<?php


//tests if the bot works
//returns an array with the telegram response
//optional parameter to print on screen if the bot works
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


function getUpdates($offset, $limit = NULL, $timeout = NULL, $allowed_updates = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
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


function setWebhook($api, $url, $certificate = NULL, $max_connections = NULL, $allowed_updates = NULL)
{
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'url' => $url
		);
	if(isset($max_connections))
	{
		$args['max_connections'] = $max_connections;
	}
	if(isset($allowed_updates))
	{
		$args['allowed_updates'] = $allowed_updates;
	}
	if(isset($certificate))
	{
		$file_name = realpath($certificate);
		$certificate = curl_file_create($file_name);
		$args['certificate'] = $certificate;
		$rr = curlRequest("setWebhook", $args);
	}
	else
	{
		$params = http_build_query($args);
		$r = file_get_contents("https://api.telegram.org/bot$api/setWebhook?$params", false, $context);
		$rr = json_decode($r, true);
	}
	return $rr;
}


function deleteWebhook()
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$r = file_get_contents("https://api.telegram.org/bot$api/deleteWebhook", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


//Webhook URL, may be empty if webhook is not set up
function getWebhookInfo($verbose = false)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$r = file_get_contents("https://api.telegram.org/bot$api/getWebhookInfo", false, $context);
	$rr = json_decode($r, true);

	if($verbose)
	{
		if($rr['ok'])
		{
			$bot = $rr['result']['url'];
			echo "URL: " . $bot;
		}
		else
		{
			echo "API ID wrong or impossible to connect to Telegram";
		}
	}
	return $rr;
}

