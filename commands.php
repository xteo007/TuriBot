<?php
require "bot.php";


//tests if the bot works and prints on page the name of the bot
getMe(true);


//saves last request for debug
$file = "update.json";
$f = fopen($file, 'w');
fwrite($f, $content);
fclose($f);


//a simple message when /start or /help is received from update
if(stripos($message_text, "/start")===0 or stripos($message_text, "/help")===0)
{
	sendMessage($message_chat_id, "/help - Show this message\n/license - Sends you the link of the page with the license and source code of the bot");
}


//shows license of the bot
if(stripos($message_text, "/license")===0)
{
	sendMessage($message_chat_id, "Copyright (C) 2017 Davide Turaccio\nThis program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or at your option) any later version.\nThis program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.\nYou should have received a copy of the GNU Affero General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.\n\nThe source code of this bot is avaible on https://github.com/davtur19/php-telegram-bot-api");
}


//a message with the user's name, response to the user's message, and buttons
if(stripos($message_text, "/message")===0)
{
	$menu['inline_keyboard'] = array(
		array(
			array(
			"text" => "Button 1",
			"callback_data" => "btn1"
			)
		),
		array(
			array(
			"text" => "Button 2",
			"callback_data" => "btn2"
			),
			array(
			"text" => "Button 3",
			"callback_data" => "btn3"
			)
		)
	);
	sendMessage($message_chat_id, "Hi " . $message_from_first_name . "\n" . $message_text, "Markdown", false, false, $message_message_id, $menu);
}


//edits the message and notifies the user
if(stripos($callback_query_data, "btn1")===0)
{
	$menu['inline_keyboard'] = array(
		array(
			array(
			"text" => "Button 1",
			"callback_data" => "btn1"
			)
		),
		array(
			array(
			"text" => "Button 2",
			"callback_data" => "btn2"
			),
			array(
			"text" => "Button 3",
			"callback_data" => "btn3"
			)
		)
	);
	$info2 = answerCallbackQuery($callback_query_id, "Button 1");
	editMessageText("Button 1", $callback_query_message_chat_id, $callback_query_message_message_id, NULL, NULL, NULL, $menu);
}


//it will only work if you have a photo.jpg in the bot folder
if(stripos($message_text, "/photo")===0)
{
	sendPhoto($message_chat_id, "photo.jpg");
}
