<?php
    /*
     * This file contains the commands that send the user
     * The array key is the command itself
     * All commands must begin with a `/`
     *
     * Commands are used to process entered data or actions on user messages
     * You can create any number of commands
     *
     * The most striking example of a command is the output of the username of the person who sent the message
     *
     * Commands can be combined with the phrases of the bot. This will create a more live communication with the bot
     *
     * When the application grows, you can create commands to register users to the database
     *
     * All commands must return message text
     *
     * the command function must have two arguments
     *  - a copy of the class vk api
     *  - data from the server vk
     */
    return [
        '/hello' => function($vk = NULL, $data = NULL) { // command to greet the user
            $user = $vk->getUser($data['object']['user_id']);
            return "Hello, ".$user['first_name']." ".$user['last_name']."!";
        },
        '/my' => function($vk = NULL, $data = NULL) { // output username
            $user = $vk->getUser($data['object']['user_id']);
            return "You name '".$user['first_name']." ".$user['last_name']."'";
        }
    ];