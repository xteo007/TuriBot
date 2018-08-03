<?php

function debug()
{
    global $chat_id;

    $args = func_get_args();

    if (!isset($chat_id) or $chat_id == 0 or $chat_id == '') {
        $id = MYID;
    } else {
        $id = $chat_id;
    }

    foreach ($args as $debug) {
        $str = var_export($debug, true);
        $array_str = str_split($str, 4050);

        foreach ($array_str as $value) {
            sendMessage($id, 'Debug:' . PHP_EOL . '```' . $value . '```', 'Markdown');
        }
    }

    return true;
}