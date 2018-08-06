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
        'url' => $url,
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

    return curlRequestApi($api, 'setWebhook', $args);
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
            echo 'URL: '.$bot;
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