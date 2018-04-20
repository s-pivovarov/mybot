<?php

    class Bot {
        public function getPhrases($phrasesArr) {
            return $phrasesArr[rand(0, count($phrasesArr) - 1)];
        } // select a random phrase from an array
    }