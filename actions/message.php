<?php
    $user_id = $data['object']['user_id']; // user id in vk
    $commands = include('src/commands.php'); // connecting commands
    $bot_phrases = include('src/phrases/bot.php'); // connecting bot phrases
    $user_phrases = include('src/phrases/user.php'); // connecting user phrases

    $message = $data['object']['body']; // message
    if($message[0] == '/') { // if message is command
        if(isset($commands[$message])) // if is there such a team
            $vk->message($user_id, $commands[$message]($vk, $data)); // process the command and send the response
        else
            $vk->message($user_id, $bot->getPhrases($bot_phrases['undefined'])); // send the response - undefined phrases

        return; // quit the script
    }

    $upper_message = strtoupper($message);
    $phrase_key = false;
    foreach ($user_phrases as $key=>$item) { // search for a phrase and save its key
        foreach ($item as $phrase) {
            if(strtoupper($phrase) == $upper_message) { // if the phrase is found
                $phrase_key = true; // set flag
                break;
            }
        }

        if($phrase_key) { // if the phrase is found
            $phrase_key = $key; // save phrase key
            break;
        }
    }

    $phrase_key = !$phrase_key ? 'undefined' : $phrase_key; // check the key to existence
    $phrase = $bot->getPhrases($bot_phrases[$phrase_key]); // get random phrases in array

    if($phrase[0] == '/') { // if phrases is command
        $vk->message($user_id, $commands[$phrase]($vk, $data)); // process the command and send the response
    } else {
        $vk->message($user_id, $phrase); // send the response message
    }