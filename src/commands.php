<?php

    return [
        '/hello' => function($vk = NULL, $data = NULL) {
            $user = $vk->getUser($data['object']['user_id']);
            return "Hello, ".$user['first_name']." ".$user['last_name']."!";
        },
        '/my' => function($vk = NULL, $data = NULL) {
            $user = $vk->getUser($data['object']['user_id']);
            return "You name '".$user['first_name']." ".$user['last_name']."'";
        }
    ];