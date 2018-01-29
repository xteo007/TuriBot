<?php


//tests if the bot works
//returns an array with the telegram response
//optional parameter to print on screen if the bot works
function getMe()
{
	$rr = curlRequest("getMe");
	return $rr;
}


function getUpdates($offset, $limit = NULL, $timeout = NULL, $allowed_updates = NULL)
{
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

	if(isset($args))
	{
        $rr = curlRequest("getUpdates", $args);
    }
    else
    {
        $rr = curlRequest("getUpdates");
    }
	return $rr;
}


function setWebhook($api, $url, $certificate = NULL, $max_connections = NULL, $allowed_updates = NULL)
{
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
	}
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$api/setWebhook");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$r = curl_exec($ch);
	curl_close($ch);
	$rr = json_decode($r, true);
	
	return $rr;
}


function deleteWebhook()
{
	$rr = curlRequest("deleteWebhook");
	return $rr;
}


//Webhook URL, may be empty if webhook is not set up
function getWebhookInfo($verbose = false)
{
	$rr = curlRequest("getWebhookInfo");
	
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

