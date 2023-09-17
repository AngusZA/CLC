<?php
    require 'vendor/autoload.php';
    
    use CLC\Handlers\Router;
    use CLC\Env;

    Env::setEnvironmentVariables();
     
    $router = new Router();

    $router->addRoute('GET','/login','CLC\Controllers\UserController@login');
    $router->addRoute('POST','/user','CLC\Controllers\UserController@logUserIn');
    $router->addRoute('GET','/user','CLC\Controllers\UserController@user');
    $router->addRoute('GET','/','CLC\Controllers\HomeController@index');
    $router->addRoute('GET','/create-user','CLC\Controllers\UserController@createUserForm');
    $router->addRoute('POST','/create-user','CLC\Controllers\UserController@createUser');


    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $requestUri = $_SERVER['REQUEST_URI'];
    $router->route($requestMethod,$requestUri);