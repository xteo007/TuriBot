<?php

/**
 *    Copyright (C) 2017-2018  Davide Turaccio
 *
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU Affero General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 **/

//replace 1111 with your id
define('MYID', 1111);
//set the nickname of the bot for the recognition of the commands, lowercase!
define('NICKNAMEBOT', '@bot');
//put false if you want to use json payload for faster speed. with some server configuration it may not work properly, moreover the first request will not receive any reply from telegram
define('RESPONSE', true);
//if you do not want to use the variables generated automatically by the telegram update but directly the array of $update put the parameter below to false
define('EASY_VAR', true);



if (!isset($_GET['api'])) {
    exit();
}


//receiving updates via the webhook
$content = file_get_contents('php://input');
$update = json_decode($content, true);

//saves last request for debug
$file = 'update.json';
$f = fopen($file, 'w');
fwrite($f, $content);
fclose($f);


//All variables are created automatically without the need of $update['message']['text']; (you can simply use $message_text)
//Variables are created using the available telegram types fields https://core.telegram.org/bots/api#available-types
//To get a list of all the variables, visit https://core.telegram.org/bots/api#update
//For example, the update object https://core.telegram.org/bots/api#update has "edited_message" (if there is no edited message in the update received from Telegram the variable will not exist) to read the contents of the text you can just have a look at the type used for edited_message that corresponds to "message" https://core.telegram.org/bots/api#message, if you want to read the message text just use $message_text ("message" + _ + "text")

if (EASY_VAR) {
    //scan update
    if (isset($update)) {
        sendMessage(MYID, '*$update* = `' . print_r($update, true) . '`' . PHP_EOL, 'Markdown');
        if (is_array($update)) {
            foreach ($update as $update_key => $update_val) {
                //check if the var already exist for security reasons
                if (!isset($$update_key)) {
                    //$$ is a variable variable http://php.net/manual/en/language.variables.variable.php
                    $$update_key = $update_val;
                    if (is_array($$update_key)) {
                        //scan field of update (message/edited_message/channel_post/edited_channel_post...)
                        foreach ($$update_key as $update_field_key => $update_field_val) {
                            if (!isset($$update_field_key)) {
                                $$update_field_key = $update_field_val;
                                if (is_array($$update_field_key)) {
                                    //scan field of update of message/edited_message/channel_post/edited_channel_post... (message_id,from,date,chat...) https://core.telegram.org/bots/api#update
                                    foreach ($$update_field_key as $update_scan_key => $update_scan_val) {
                                        $update_scan_key = $update_field_key . '_' . $update_scan_key;
                                        if (!isset($$update_scan_key)) {
                                            $$update_scan_key = $update_scan_val;
                                            if (is_array($$update_scan_key)) {
                                                //scan field of update of message/edited_message/channel_post/edited_channel_post... of from,chat,forward_from,forward_from_chat...
                                                foreach ($$update_scan_key as $update_scan2_key => $update_scan2_val) {
                                                    $update_scan2_key = $update_scan_key . '_' . $update_scan2_key;
                                                    if (!isset($$update_scan2_key)) {
                                                        $$update_scan2_key = $update_scan2_val;
                                                        if (is_array($$update_scan2_key)) {
                                                            //another scan...
                                                            foreach ($$update_scan2_key as $update_scan3_key => $update_scan3_val) {
                                                                $update_scan3_key = $update_scan2_key . '_' . $update_scan3_key;
                                                                if (!isset($$update_scan3_key)) {
                                                                    $$update_scan3_key = $update_scan3_val;
                                                                    if (is_array($$update_scan3_key)) {
                                                                        foreach ($$update_scan3_key as $update_scan4_key => $update_scan4_val) {
                                                                            $update_scan4_key = $update_scan3_key . '_' . $update_scan4_key;
                                                                            if (!isset($$update_scan4_key)) {
                                                                                $$update_scan4_key = $update_scan4_val;
                                                                                if (is_array($$update_scan4_key)) {
                                                                                    foreach ($$update_scan4_key as $update_scan5_key => $update_scan5_val) {
                                                                                        if (!isset($$update_scan5_key)) {
                                                                                            $$update_scan5_key = $update_scan5_val;
                                                                                            sendMessage(MYID,
                                                                                                '*$' . $update_scan5_key . '* = `' . print_r($update_scan5_val,
                                                                                                    true) . '`' . PHP_EOL,
                                                                                                'Markdown');
                                                                                        }
                                                                                    }
                                                                                } else {
                                                                                    sendMessage(MYID,
                                                                                        '*$' . $update_scan4_key . '* = `' . print_r($update_scan4_val,
                                                                                            true) . '`' . PHP_EOL,
                                                                                        'Markdown');
                                                                                }
                                                                            }
                                                                        }
                                                                    } else {
                                                                        sendMessage(MYID,
                                                                            '*$' . $update_scan3_key . '* = `' . print_r($update_scan3_val,
                                                                                true) . '`' . PHP_EOL, 'Markdown');
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            sendMessage(MYID,
                                                                '*$' . $update_scan2_key . '* = `' . print_r($update_scan2_val,
                                                                    true) . '`' . PHP_EOL, 'Markdown');
                                                        }
                                                    }
                                                }
                                            } else {
                                                sendMessage(MYID,
                                                    '*$' . $update_scan_key . '* = `' . print_r($update_scan_val,
                                                        true) . '`' . PHP_EOL, 'Markdown');
                                            }
                                        }
                                    }
                                } else {
                                    sendMessage(MYID, '*$' . $update_field_key . '* = `' . print_r($update_field_val,
                                            true) . '`' . PHP_EOL, 'Markdown');
                                }
                            }
                        }
                    } else {
                        sendMessage(MYID, '*$' . $update_key . '* = `' . print_r($update_val, true) . '`' . PHP_EOL,
                            'Markdown');
                    }
                }
            }
        }
    }
}

$payload = RESPONSE;

function jsonPayload($method, $args = [])
{
    global $payload;

    if ($payload) {
        $args['method'] = $method;
        $json = json_encode($args);

        ob_start();
        echo $json;
        header('Content-Type: application/json');
        header('Connection: close');
        header('Content-Length: ' . strlen($json));
        ob_end_flush();
        ob_flush();
        flush();

        $payload = false;

        return true;
    } else {
        return curlRequest($method, $args);
    }
}


function curlRequest($method, $args = [])
{
    $c = curl_init();
    curl_setopt_array($c, [
        CURLOPT_URL            => 'https://api.telegram.org/bot' . $_GET['api'] . '/' . $method,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $args
    ]);
    $r = curl_exec($c);
    curl_close($c);

    return json_decode($r, true);
}


function curlRequestApi($api, $method, $args = [])
{
    $c = curl_init();
    curl_setopt_array($c, [
        CURLOPT_URL            => 'https://api.telegram.org/bot' . $api . '/' . $method,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $args
    ]);
    $r = curl_exec($c);
    curl_close($c);

    return json_decode($r, true);
}


//base functions
function sendMessage(
    $chat_id,
    $text,
    $parse_mode = null,
    $disable_web_page_preview = null,
    $disable_notification = null,
    $reply_to_message_id = null,
    $reply_markup = null,
    $response = RESPONSE
) {
    $args = [
        'chat_id' => $chat_id,
        'text'    => $text
    ];
    if (isset($parse_mode)) {
        $args['parse_mode'] = $parse_mode;
    }
    if (isset($disable_web_page_preview)) {
        $args['disable_web_page_preview'] = $disable_web_page_preview;
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
        return curlRequest('sendMessage', $args);
    } else {
        return jsonPayload('sendMessage', $args);
    }

}


function forwardMessage($chat_id, $from_chat_id, $disable_notification = null, $message_id, $response = RESPONSE)
{
    $args = [
        'chat_id'      => $chat_id,
        'from_chat_id' => $from_chat_id,
        'message_id'   => $message_id
    ];
    if (isset($disable_notification)) {
        $args['disable_notification'] = $disable_notification;
    }

    if ($response) {
        return curlRequest('forwardMessage', $args);
    } else {
        return jsonPayload('forwardMessage', $args);
    }
}


include_once 'functions/media.php';
include_once 'functions/edit.php';
include_once 'functions/admin.php';
include_once 'functions/get_info.php';
include_once 'functions/status.php';
include_once 'functions/location.php';
include_once 'functions/updates.php';
include_once 'functions/inline.php';
include_once 'functions/stickers.php';
include_once 'functions/payments.php';
include_once 'functions/games.php';

include_once 'functions/input.php';
include_once 'functions/debug.php';
