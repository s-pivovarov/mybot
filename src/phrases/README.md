In this folder, there are all the phrases that the application processes.

> `bot.php` - phrases sent by the bot
> `user.php` - phrases sent by the user

Bot, works on the scheme `Question - Answer`. As Jarvis in the Iron Man)))

Each file has an array, the keys of which correspond to the key of another array.
Example:

```text
     The user sent a message "Hello".
     The application loads the array user.php
     Looks for the phrase "HELLO" (all phrases are compared in a large register)
     Takes her key - 'hello'
     And as an answer, sends a random phrase from bot.php with the key 'hello'
    
     phrases with the 'undefined' key are called if the bot did not find the appropriate phrase in user.php
    
     In the array, you can also add the command
     Example: 'my' => ['/ my'],
     Everything works on the same algorithm, except for one moment
     Before sending a response, the command will be processed and only then the response will be sent
```

> bot.php
```php
    return [
        'hello' => ['Hi', 'Hello!', 'Hello my friend!', '/hello'],
        'my' => ['/my'],
        'undefined' => ['I do not understand']
    ];
```

> user.php
```php
    return  [
        'hello' => ['Hello', 'Hey', 'Hola'],
        'my' => ['My mane', 'I']
    ];
```