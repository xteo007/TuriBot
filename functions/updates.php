<?php


//tests if the bot works
//returns an array with the telegram response
function getMe()
{
    return curlRequest('getMe');
}


function getMeApi($api)
{
    return curlRequestApi($api, 'getMe');
}


function getUpdates($offset, $limit = null, $timeout = null, $allowed_updates = null)
{
    if (isset($offset)) {
        $args['offset'] = $offset;
    }
    if (isset($limit)) {
        $args['limit'] = $limit;
    }
    if (isset($timeout)) {
        $args['timeout'] = $timeout;
    }
    if (isset($allowed_updates)) {
        $args['allowed_updates'] = $allowed_updates;
    }

    if (isset($args)) {
        return curlRequest('getUpdates', $args);
    } else {
        return curlRequest('getUpdates');
    }
}


function setWebhook($api, $url, $certificate = null, $max_connections = null, $allowed_updates = null)
{
    $args = [
        'url' => $url
    ];
    if (isset($max_connections)) {
        $args['max_connections'] = $max_connections;
    }
    if (isset($allowed_updates)) {
        $args['allowed_updates'] = $allowed_updates;
    }
    if (isset($certificate)) {
        $file_name = realpath($certificate);
        $certificate = curl_file_create($file_name);
        $args['certificate'] = $certificate;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.telegram.org/bot' . $api . '/setWebhook');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $r = curl_exec($ch);
    curl_close($ch);

    return json_decode($r, true);
}


function deleteWebhook()
{
    return curlRequest('deleteWebhook');
}


//Webhook URL, may be empty if webhook is not set up
function getWebhookInfo($verbose = false)
{
    $rr = curlRequest('getWebhookInfo');

    if ($verbose) {
        if ($rr['ok']) {
            $bot = $rr['result']['url'];
            echo 'URL: ' . $bot;
        } else {
            echo 'API ID wrong or impossible to connect to Telegram';
        }
    }

    return $rr;
}

function getWebhookInfoApi($api)
{
    return curlRequestApi($api, 'getWebhookInfo');
}