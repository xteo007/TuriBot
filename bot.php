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

if (!isset($_GET['api'])) {
    exit();
}

require_once 'config.php';

$jsonPayload = !RESPONSE;
$curlRequestSession = null;

//receiving updates via the WebHook
$update = json_decode(file_get_contents('php://input'), true);


//All variables are created automatically without the need of $update['message']['text']; (you can simply use $message_text)
//Variables are created using the available telegram types fields https://core.telegram.org/bots/api#available-types
//To get a list of all the variables, visit https://core.telegram.org/bots/api#update
//For example, the update object https://core.telegram.org/bots/api#update has "edited_message" (if there is no edited message in the update received from Telegram the variable will not exist) to read the contents of the text you can just have a look at the type used for edited_message that corresponds to "message" https://core.telegram.org/bots/api#message, if you want to read the message text just use $message_text ("message" + _ + "text")
if (EASY_VAR === true) {
    //scan update
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
                                    $update_scan_key = $update_field_key.'_'.$update_scan_key;
                                    if (!isset($$update_scan_key)) {
                                        $$update_scan_key = $update_scan_val;
                                        if (is_array($$update_scan_key)) {
                                            //scan field of update of message/edited_message/channel_post/edited_channel_post... of from,chat,forward_from,forward_from_chat...
                                            foreach ($$update_scan_key as $update_scan2_key => $update_scan2_val) {
                                                $update_scan2_key = $update_scan_key.'_'.$update_scan2_key;
                                                if (!isset($$update_scan2_key)) {
                                                    $$update_scan2_key = $update_scan2_val;
                                                    if (is_array($$update_scan2_key)) {
                                                        //another scan...
                                                        foreach ($$update_scan2_key as $update_scan3_key => $update_scan3_val) {
                                                            $update_scan3_key = $update_scan2_key.'_'.$update_scan3_key;
                                                            if (!isset($$update_scan3_key)) {
                                                                $$update_scan3_key = $update_scan3_val;
                                                                if (is_array($$update_scan3_key)) {
                                                                    foreach ($$update_scan3_key as $update_scan4_key => $update_scan4_val) {
                                                                        $update_scan4_key = $update_scan3_key.'_'.$update_scan4_key;
                                                                        if (!isset($$update_scan4_key)) {
                                                                            $$update_scan4_key = $update_scan4_val;
                                                                            if (is_array($$update_scan4_key)) {
                                                                                foreach ($$update_scan4_key as $update_scan5_key => $update_scan5_val) {
                                                                                    if (!isset($$update_scan5_key)) {
                                                                                        $$update_scan5_key = $update_scan5_val;
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}


require_once 'base_functions.php';
