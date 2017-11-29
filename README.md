# php-telegram-bot-api

[![Donate](https://img.shields.io/badge/%F0%9F%92%99-Donate-blue.svg)](https://www.paypal.me/davtur19)

PHP Telegram Bot API is a simple way to communicate with telegram APIs

.htaccess file is not needed for the bot, but it is recommended to use it to allow requests only from Telegram servers and also to not allow access to files and indexing (tested on apache2)

```
/bot
|   .htaccess
|   bot.php
|   commands.php
|   LICENSE
|   setup.php
|   tree.txt
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
