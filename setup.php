<?php

require_once "bot.php";

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
	setWebhook($api, $link);
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
