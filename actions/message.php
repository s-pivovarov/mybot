<?php
    $user_id = $data['object']['user_id'];
    $commands = include('src/commands.php');
    $bot_phrases = include('src/phrases/bot.php');
    $user_phrases = include('src/phrases/user.php');

    $message = $data['object']['body'];
    if($message[0] == '/') {
        if(isset($commands[$message]))
            $vk->message($user_id, $commands[$message]($vk, $data));
        else
            $vk->message($user_id, $bot->getPhrases($bot_phrases['undefined']));

        return;
    }

    $upper_message = strtoupper($message);
    $phrase_key = false;
    foreach ($user_phrases as $key=>$item) {
        foreach ($item as $phrase) {
            if(strtoupper($phrase) == $upper_message) {
                $phrase_key = true;
                break;
            }
        }

        if($phrase_key) {
            $phrase_key = $key;
            break;
        }
    }

    $phrase_key = !$phrase_key ? 'undefined' : $phrase_key;
    $phrase = $bot->getPhrases($bot_phrases[$phrase_key]);

    if($phrase[0] == '/') {
        $vk->message($user_id, $commands[$phrase]($vk, $data));
    } else {
        $vk->message($user_id, $phrase);
    }