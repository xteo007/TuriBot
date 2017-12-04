# php-telegram-bot-api

[![Donate](https://img.shields.io/badge/%F0%9F%92%99-Donate-blue.svg)](https://www.paypal.me/davtur19)

PHP Telegram Bot API is a simple way to communicate with telegram APIs

.htaccess file is not needed for the bot, but it is recommended to use it to allow requests only from Telegram servers and also to not allow access to files and indexing (tested on apache2)


Documentation is only in Italian at the moment

# Guida
## Setup
Caricare i file su un webserver e impostare il webhook manualmente che punti a commands.php, oppure aprire dal browser il file setup.php e fare il setup con esso.

In alternativa si può settare il webhook che punti a bot.php e includere commands.php (togliendo include "bot.php"; da commands.php)
## Nomi delle variabili
I nomi delle variabili sono create in modo dinamico e esse esisteranno solo se presenti nel update ricevuto da Telegram. Come nomi hanno gli stessi campi degli array mandati dalle richieste di update tramite webhook di Telegram. Inoltre la prima dimensione del array viene esclusa per creare i nomi delle variabili che sono separate da un underscore.

Nonostante la prima dimesione dell'array non venga usata per creare i nomi delle variabili, è possibile usare $message, $edited_message, $channel_post, ecc... per distinguere i vari messaggi, ad esempio per capire se il messaggio ricevuto è un messaggio normale o modificato.
(Vedere qua per i nomi: https://core.telegram.org/bots/api#update)

Possono essere usati anche i nomi delle variabili non completi

Per esempio:
$chat_id conterrà 'id' che è all'interno del array di 'chat'.
Mentre facendo solo $chat conterrà l'array di 'chat'.
(Per maggiori info sui nomi guardare le api di Telegram https://core.telegram.org/bots/api#chat)

## Funzionamento del bot:
1. Quando il bot riceve un messaggio, Telegram manda un json come quello qua sotto, alla pagina a cui è settato il webhook.
1. Poi questo json viene decodificato e messo nella variabile $update che sarà un array come quello qua sotto.
1. Dopodichè vengono create le variabili usando i campi del array e vengono separati da un underscore, tranne per la prima dimensionde del array (ovvero i campi di update come update_id, message, edited_message, channel_post, ecc..).

Json mandato da Telegram
```
{
"update_id":10000,
"message":{
  "date":1441645532,
  "chat":{
     "last_name":"Test Lastname",
     "id":1111111,
     "first_name":"Test",
     "username":"Test"
  },
  "message_id":1365,
  "from":{
     "last_name":"Test Lastname",
     "id":1111111,
     "first_name":"Test",
     "username":"Test"
  },
  "text":"/start"
}
}
```
Contenuto di $update
```
array(2) {
  ["update_id"]=>
  int(10000)
  ["message"]=>
  array(5) {
    ["date"]=>
    int(1441645532)
    ["chat"]=>
    array(4) {
      ["last_name"]=>
      string(13) "Test Lastname"
      ["id"]=>
      int(1111111)
      ["first_name"]=>
      string(4) "Test"
      ["username"]=>
      string(4) "Test"
    }
    ["message_id"]=>
    int(1365)
    ["from"]=>
    array(4) {
      ["last_name"]=>
      string(13) "Test Lastname"
      ["id"]=>
      int(1111111)
      ["first_name"]=>
      string(4) "Test"
      ["username"]=>
      string(4) "Test"
    }
    ["text"]=>
    string(6) "/start"
  }
}
```
Esempio di alcune variabili seguendo l'array usato sompra
```
$chat
["chat"]=>
    array(4) {
      ["last_name"]=>
      string(13) "Test Lastname"
      ["id"]=>
      int(1111111)
      ["first_name"]=>
      string(4) "Test"
      ["username"]=>
      string(4) "Test"
    }
    
$chat_id
1111111

$update_id
10000

$message_id_from_username
Test

$message
["message"]=>
  array(5) {
    ["date"]=>
    int(1441645532)
    ["chat"]=>
    array(4) {
      ["last_name"]=>
      string(13) "Test Lastname"
      ["id"]=>
      int(1111111)
      ["first_name"]=>
      string(4) "Test"
      ["username"]=>
      string(4) "Test"
    }
    ["message_id"]=>
    int(1365)
    ["from"]=>
    array(4) {
      ["last_name"]=>
      string(13) "Test Lastname"
      ["id"]=>
      int(1111111)
      ["first_name"]=>
      string(4) "Test"
      ["username"]=>
      string(4) "Test"
    }
    ["text"]=>
    string(6) "/start"
  }
```
## Divisione dei file
Nella directory principale troviamo:
* .htaccess serve per permettere richieste solo dai server di telegram ma non è un file necessario per il funzionamento. Attenzione questo file potrebbe non funzionare su tutti i webserver, è stato testato su apache2.
* bot.php è il file principale che elabora gli update e richiama i file con all'interno le varie funzioni.
* commands.php è un file di esempio con dei comandi base per il bot.
* functions è la cartella con le varie funzioni
* setup.php serve solo per settare il webhook in modo facile
* LICENSE il file con la licenza (GNU Affero General Public License v3.0)

Questa è la divisione delle varie funzioni nei file, sono chiamate con lo stesso nome dei metodi disponibili di Telegram
```
/bot
|   .htaccess
|   bot.php
|   commands.php
|   LICENSE
|   setup.php
|   
\---functions
    +---admin.php
    |       deleteChatPhoto
    |       exportChatInviteLink
    |       getChatAdministrators
    |       getChatMember
    |       getChatMembersCount
    |       kickChatMember
    |       leaveChat
    |       pinChatMessage
    |       promoteChatMember
    |       restrictChatMember
    |       setChatDescription
    |       setChatPhoto
    |       setChatTitle
    |       unbanChatMember
    |       unpinChatMessage
    |       
    +---edit.php
    |       deleteMessage
    |       editMessageCaption
    |       editMessageReplyMarkup
    |       editMessageText
    |       
    +---games.php
    |       getGameHighScores
    |       sendGame
    |       setGameScore
    |       
    +---get_info.php
    |       getChat
    |       getFile
    |       getUserProfilePhotos
    |       
    +---inline.php
    |       answerInlineQuery
    |       
    +---location.php
    |       editMessageLiveLocation
    |       sendLocation
    |       sendVenue
    |       stopMessageLiveLocation
    |       
    +---media.php
    |       sendAudio
    |       sendContact
    |       sendDocument
    |       sendMediaGroup
    |       sendPhoto
    |       sendVideo
    |       sendVideoNote
    |       sendVoice
    |       
    +---payments.php
    |       answerPreCheckoutQuery
    |       answerShippingQuery
    |       sendInvoice
    |       
    +---status.php
    |       answerCallbackQuery
    |       sendChatAction
    |       
    +---stickers.php
    |       addStickerToSet
    |       createNewStickerSet
    |       deleteChatStickerSet
    |       deleteStickerFromSet
    |       getStickerSet
    |       sendSticker
    |       setChatStickerSet
    |       setStickerPositionInSet
    |       uploadStickerFile
    |       
    \---updates.php
            deleteWebhook
            getMe
            getUpdates
            getWebhookInfo
            setWebhook
```


