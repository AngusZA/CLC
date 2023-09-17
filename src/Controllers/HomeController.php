<?php
    namespace CLC\Controllers;

    class HomeController 
    {
        function index(){
            require_once(__DIR__."/../Pages/Homepage.php");
        }
    }
    