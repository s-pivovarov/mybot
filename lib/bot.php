<?php

    class Bot {
        public function getPhrases($phrasesArr) {
            return $phrasesArr[rand(0, count($phrasesArr) - 1)];
        }
    }