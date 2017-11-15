<?php

echo "<form action='setup.php' method='POST'>";

if(isset($_POST['yes']))
{
	if(isset($_POST['link']))
	{
		$actual_link = $_POST['link'];
	}
	else
	{
		$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";	
		$explode = explode("setup.php", $actual_link);
		$actual_link = $explode[0] . "commands.php";
	}
	echo "<p><input type='hidden' name='link' value='$actual_link' /></p>";
	echo "<p>Input API Token: <input type='text' name='api' value='' style='width:400px;' /></p>";
	echo "<p>Example: 123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11</p>";
	echo "<p><button type='submit' name='submit'>Submit</button></p>";
}
elseif(isset($_POST['api']))
{
	$api = $_POST['api'];
	$link = $_POST['link'];
	$link = $link . "?api=" . $api;
	function setWebhook($url, $certificate = NULL, $max_connections = NULL, $allowed_updates = NULL)
	{
		global $api;
		$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));		$context = stream_context_create($options);
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
	function getMe($verbose = false)
	{
		global $api;
		$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));		$context = stream_context_create($options);
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
	setWebhook($link);
	getMe(true);
}
elseif(isset($_POST['no']))
{
	echo "<p>Input Link: <input type='text' name='link' value='' /></p>";
	echo "<p>HTTPS link is required!</p>";
	echo "<p>Example: https://mysite.com/bot/command.php</p>";
	echo "<p><button type='submit' name='yes'>Submit</button></p>";
}
else
{
	$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";	
	$explode = explode("setup.php", $actual_link);
	echo "<p>The link is correct?</p>";
	echo "<p>" . $explode[0] . "commands.php</p>";
	echo "<p><button type='submit' name='yes'>Yes</button>";
	echo "<button type='submit' name='no'>No</button></p>";
}

echo "</form>";
