<?php

function debug($debug)
{
    global $chat_id;

    if (!isset($chat_id) or $chat_id == 0 or $chat_id == '') {
        $chat_id = MYID;
    }

    $str = print_r($debug, true);
    $array_str = str_split($str, 4050);

    foreach ($array_str as $value) {
        sendMessage($chat_id, 'Debug:' . PHP_EOL . $value);
    }

    return true;
}