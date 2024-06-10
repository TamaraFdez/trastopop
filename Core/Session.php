<?php

namespace Core;

class Session
{

    static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
    }

    static function has($key)
    {
        return isset($_SESSION[$key]);
    }
    
    static function clear($key){
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }

    static function clearAll(){
      session_unset();
      session_destroy();
    }
}
