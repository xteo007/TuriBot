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
elseif(isset($_POST['connections']))
{
    $api = $_POST['api'];
    $link = $_POST['link'];
    $connections = $_POST['connections'];
    $link = $link . "?api=" . $api;
    setWebhook($api, $link, NULL, $connections);
    $response = getMe();
    if($response['ok'])
    {
        $username = $response['result']['username'];
        echo "Setup successful: <a href='http://t.me/$username'> @" . $username . "</a>";
    }
    else
    {
        echo "Setup failed: API ID wrong or impossible to connect to Telegram";
    }
}
elseif(isset($_POST['skip']))
{
    $api = $_POST['api'];
    $link = $_POST['link'];
    $link = $link . "?api=" . $api;
    setWebhook($api, $link);
}
elseif(isset($_POST['api']))
{
	$api = $_POST['api'];
	$link = $_POST['link'];
    echo "<p><input type='hidden' name='api' value='$api' /></p>";
    echo "<p><input type='hidden' name='link' value='$link' /></p>";
    echo "<p>Input max connections: <input type='number' name='connections' min='0' max='100' value='40'></p>";
    echo "<p>If you are not sure, press Skip</p>";
    echo "<p>Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100. Defaults to 40. Use lower values to limit the load on your bot‘s server, and higher values to increase your bot’s throughput.</p>";
    echo "<p><button type='submit' name='submit'>Submit</button>";
    echo "<button type='submit' name='skip'>Skip</button></p>";
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
	echo "<p>Is the link correct?</p>";
	echo "<p>" . $explode[0] . "commands.php</p>";
	echo "<p><button type='submit' name='yes'>Yes</button>";
	echo "<button type='submit' name='no'>No</button></p>";
}

echo "</form>";
