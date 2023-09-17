<?php
    namespace CLC;

    class Env 
    {
        static function startSession(){
            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
        }

        static function setEnvironmentVariables(){
            putenv("DSN=mysql:dbname=clc;host=127.0.0.1:3308");
            putenv("DB_PASSWORD=");
            putenv("DB_USER=root");
        }
    }
    