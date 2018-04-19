<?php

    class VK {
        private $access_token;
        private $confirm_key;
        private $status;

        function __construct($status, $access_token, $confirm_key) {
            $this->status = $status;
            $this->access_token = $access_token;
            $this->confirm_key = $confirm_key;
        }

        public function getConfirm() {
            return $this->confirm_key;
        }

        public function vkAPI($method, $params) {
            $url = 'https://api.vk.com/method/';
            $url .= $method.'?'.http_build_query($params);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($curl);
            curl_close($curl);
            $res = json_decode($json, true);

            return $res;
        } // запрос к API

        public function message($vk_id, $message, $attachments = array()) {
            $method = 'messages.send';
            $params = [
                'peer_id' => $vk_id,
                'message' => $message,
                'attachment' => implode(',', $attachments),
                'v' => API_VERSION,
                'access_token' => $this->access_token
            ];

            if($this->status == 'dev') {
                echo $message.'\n';
                return true;
            }

            return $this->vkAPI($method, $params)['response'];
        }

        public function getUser($user_id) {
            $user = $this->vkAPI('users.get', [
                'user_ids' => $user_id,
                'v' => API_VERSION
            ]);

            if(isset($user['error'])) {
                return 'Error!';
            }

            if(count($user['response']) == 0) {
                return 'Hmm... You is not user';
            }

            return $user['response'][0];
        }
    }