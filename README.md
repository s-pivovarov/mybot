Mini chat-bot
==============


<p align="center">Chat bot is designed based on `VK Callback API`</p>

> Bot working example: <a href="https://vk.com/club165341629">MyBot</a>

`Callback API` works on the principle of events in any programming language - an event 
is initialized on the server vk, and as the handler is **your** server.

To not overload the server, you can select certain types of events in the
configuring your community vk.

All data is transmitted in the format _json_.

# Installing the Bot
To start, you need to create a community in vk. Then, in paragraph
`Community Management> API Activities> Access Keys` need to generate 
community access key.

The next step is to deploy the bot on the server.

Tip the project from the repository
and change the settings to `config.php`
> **CONFIRM_KEY** - is on the tab `Managing the Community> Working with the API > Callback API`

```php
    define('ACCESS_TOKEN', 'a55a5ddbcfdd8c69984fe673487ca862b6f4ad2c7d0bbd0a6540091174bd6e2332bc8e29ce27c24dec2c6');
    define('CONFIRM_KEY', 'de2a6ad9');
    define('API_VERSION', '5.74');
    define('STATUS', 'dev'); // development stage `dev` - development, `prod` - release
```
After that, go to the community `Community Management > Works with the API> Callback API`
and fill out the server address and click the `Confirm` button. This will confirm that you are the owner of the server.

On the tab `Manage community > Works with API > Callback API > Events`
you need to select **Incoming message**

> **Do not forget to allow messages to be sent to the community!!!**

Done! The bot is working, you can send messages to the community.
# Types of events

To handle other types of Callback API events, add the appropriate
`case` to the body` switch`

```php
    switch ($data['type']) {
        case EVENT_CONFIRMATION:
            exit($vk->getConfirm());
        break;

        case EVENT_MESSAGE_NEW:
            include('actions/message.php');
        break;
    }
```

The project structure is designed to further develop and maintain

# Description of directories and files
- `index.php` the key file to which all requests go
- `config.php` contains global variables
- `actions /` contains files with actions by type of event
- `actions / message.php` is responsible for the event of the new message
- `lib /` libraries (mostly classes)
- `lib / vk.php` library vk API
- `lib / bot.php` library with additional functions
- `src /` the key directory in which commands and phrases are located
- `src / phrases /` directory with phrases
- `src / phrases / user.php` phrases sent by the user
- `src / phrases / bot.php` phrases that the bot answers
 
# Scheme of work
- The incoming request is transferred to an array
- the type of action is selected via `switch`
- an action file is connected - `action / * .php` or a simple module
- the response is sent

 > Author: <a href="https://vk.com/p.sergey_01">Pivovarov Sergey</a>