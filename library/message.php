<?php

namespace Equity\Library {

    class Message {

        public
            $type,
            $content;

        function __construct($type, $content) {
            $this->type = $type;
            $this->content = $content;
            $_SESSION['messages'][] = $this;
        }

        public static function Info($text) {
            if(is_array($text) && !empty($text)) {
                foreach($text AS $msg) {
                    new self('info', $msg);
                }
            }
            elseif(!empty($text)) {
                new self('info', $text);
            }
            return true;
        }

        public static function Error($text) {
            if(is_array($text) && !empty($text)) {
                foreach($text AS $msg) {
                    new self('error', $msg);
                }
            }
            elseif(!empty($text)) {
                new self('error', $text);
            }
            return false;
        }
    }

}