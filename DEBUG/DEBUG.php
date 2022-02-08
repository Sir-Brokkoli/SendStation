<?php
namespace Sendstation\Debugging;

class DEBUG{
    public static function Log($message){
        if(key_exists('DEBUG', $_SESSION) && $_SESSION['DEBUG']){
            echo "DEBUG : " . $message . "</br>";
        }
    }
}
?>