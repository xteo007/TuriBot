<?php

function debug($debug)
{
    global $chat_id;


    $str = print_r($debug, true);
    $array_str = str_split($str, 4050);

    foreach ($array_str as $value) {
        sendMessage($chat_id, 'Debug:' . PHP_EOL . $value);
    }

    return true;
}