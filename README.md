# php-telegram-bot-api

[![Donate](https://img.shields.io/badge/%F0%9F%92%99-Donate-blue.svg)](https://www.paypal.me/davtur19)

PHP Telegram Bot API is a simple way to communicate with telegram APIs

.htaccess file is not needed for the bot, but it is recommended to use it to allow requests only from Telegram servers and also to not allow access to files and indexing (tested on apache2)


Documentation is only in Italian at the moment

# Guida
Caricare i file su un webserver e impostare il webhook manualmente che punti a bot.php, oppure aprire dal browser il file setup.php e fare il setup con esso.

* Il file .htaccess serve per permettere richieste solo dai server di telegram (testato su apache2)
* bot.php è il file principale a cui settare il webhook e che riceve gli update
* commands.php è un file di esempio con dei comandi base per il bot
* LICENSE il file con la licenza (GNU Affero General Public License v3.0)
* setup.php serve per settare il webhook in modo facile
* functions è la cartella con le varie funzioni

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
