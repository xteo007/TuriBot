<?php

require_once 'functions/updates.php';


//security check
//var_dump($_POST['yes'], $_POST['api'], $_POST['link'], $_POST['connections'], $_POST['no'], $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']);
if(isset($_POST['yes']) and $_POST['yes'] !== '')
{
	echo 'Error, invalid parameter';
	exit();
}
if(isset($_POST['no']) and $_POST['no'] !== '')
{
	echo 'Error, invalid parameter';
	exit();
}
if(isset($_POST['api']))
{
	preg_match_all('/[a-zA-Z0-9:_-]/', $_POST['api'], $matches, PREG_SET_ORDER, 0);
	if(strlen($_POST['api']) !== 45 or count($matches) !== 45)
	{
		echo 'Invalid token';
		exit();
	}
}
if(isset($_POST['link']))
{
	if(!(stripos($_POST['link'], 'https://') === 0))
	{
		echo 'The link must have https://';
		exit();
	}
}
if(isset($_POST['connections']) and !((1 <= $_POST['connections']) and ($_POST['connections'] <= 100)))
{
	echo 'The connections parameter must be a number between 1 and 100';
	exit();
}




echo '<form action="setup.php" method="POST">';

if(isset($_POST['yes']))
{
	if(isset($_POST['link']))
	{
		$link = strip_tags($_POST['link']);
	}
	else
	{
		$link = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$explode = explode('setup.php', $link);
		$link = $explode[0] . 'commands.php';
	}
	echo '<p><input type="hidden" name="link" value="' . $link . '" /></p>';
    echo '<p>Input API Token: <input type="text" name="api" value="" style="width:400px;" /></p>';
    echo '<p>Example: 123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11</p>';
    echo '<p><button type="submit" name="submit">Submit</button></p>';
}
elseif(isset($_POST['connections']))
{
    $api = $_POST['api'];
    $link = strip_tags($_POST['link']);
    $connections = $_POST['connections'];
    $link = $link . '?api=' . $api;
    setWebhook($api, $link, NULL, $connections);
    $response = getMeApi($api);
    if($response['ok'])
    {
        $username = $response['result']['username'];
        echo 'Setup successful: <a href="http://t.me/' . $username . '"> @' . $username . '</a>';
    }
    else
    {
        echo 'Setup failed: API ID wrong or impossible to connect to Telegram';
        echo '<p>Click here to try the setup again: <button type="submit" name="reset">Reset</button></p>';
    }
}
elseif(isset($_POST['api']))
{
	$api = $_POST['api'];
	$link = strip_tags($_POST['link']);
    echo '<p><input type="hidden" name="api" value="' . $api . '" /></p>';
    echo '<p><input type="hidden" name="link" value="' . $link . '" /></p>';
    echo '<p>Input max connections: <input type="number" name="connections" min="0" max="100" value="100"></p>';
    echo '<p>Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100. Defaults of Bot APIs is 40. Use lower values to limit the load on your bot‘s server, and higher values to increase your bot’s throughput.</p>';
    echo '<p><button type="submit" name="submit">Submit</button>';
    echo '<button type="submit" name="skip">Skip</button></p>';
}
elseif(isset($_POST['no']))
{
	echo '<p>Input Link: <input type="text" name="link" value="" /></p>';
	echo '<p>HTTPS link is required!</p>';
	echo '<p>Example: https://mysite.com/bot/command.php</p>';
	echo '<p><button type="submit" name="yes">Submit</button></p>';
}
else
{
	$actual_link = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$explode = explode('setup.php', $actual_link);
	echo '<p>Is the link correct?</p>';
	echo '<p>' . $explode[0] . 'commands.php</p>';
	echo '<p><button type="submit" name="yes">Yes</button>';
	echo '<button type="submit" name="no">No</button></p>';
}

echo '</form>';
