<?php
/*
 * This file receives all queries in json format
 * All other `include` and` require` are relative to this file
 *
 * Example of an incoming request:
 * {
 *      "type":"message_new", // event type
 *      "object": {
 *                  "id":4832, // id event
 *                  "date":1505290381, // event time
 *                  "out":0,
 *                  "user_id":id, // user id in VK
 *                  "read_state":0,
 *                  "title":"", // title
 *                  "body":msg // message
 *      },
 *      "group_id":153298270 // id group
 * }
 */

    // types of events being processed
    define('EVENT_CONFIRMATION', 'confirmation'); // server confirmation
    define('EVENT_MESSAGE_NEW', 'message_new'); // new message event

    // connect configuration and libraries
    require_once 'config.php'; // configuration file
    require_once 'lib/vk.php'; // library vk api
    require_once 'lib/bot.php'; // additional bot functions

    if(STATUS == 'dev') { // actions during development
        ini_set('display_errors', 1);
        ini_set('error_reporting', E_ALL);

        $data = $_REQUEST; // request
    } else { // actions in release
        $data = json_decode(file_get_contents('php://input'), true); // data с vk api
    }

    // instances of classes
    $vk = new VK(STATUS, ACCESS_TOKEN, CONFIRM_KEY);
    $bot = new Bot();

    switch ($data['type']) { // event type processing
        case EVENT_CONFIRMATION:
            exit($vk->getConfirm()); // departure `conformation_key`
        break;

        case EVENT_MESSAGE_NEW:
            include('actions/message.php'); // connect the action of a new message
        break;
    }

    if(STATUS != 'dev') {
        exit('ok'); // in the release, you MUST send `ok` to the server vk
    }