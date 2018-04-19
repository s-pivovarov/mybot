<?php
    define('EVENT_CONFIRMATION', 'confirmation');
    define('EVENT_MESSAGE_NEW', 'message_new');

    require_once 'config.php';
    require_once 'lib/vk.php';
    require_once 'lib/bot.php';

    if(STATUS == 'dev') {
        ini_set('display_errors', 1);
        ini_set('error_reporting', E_ALL);

        $data = $_REQUEST;
    } else {
        $data = json_decode(file_get_contents('php://input'), true);
    }

    $vk = new VK(STATUS, ACCESS_TOKEN, CONFIRM_KEY);
    $bot = new Bot();

    switch ($data['type']) {
        case EVENT_CONFIRMATION:
            exit($vk->getConfirm());
        break;

        case EVENT_MESSAGE_NEW:
            include('actions/message.php');
        break;
    }

    if(STATUS != 'dev') {
        exit('ok');
    }