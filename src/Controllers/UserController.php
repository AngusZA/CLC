<?php
    namespace CLC\Controllers;

    use CLC\Handlers\UserHandler;
    use CLC\Entities\User;
    use SimpleCaptcha\Builder;
    use CLC\Env;

    class UserController 
    {
        private UserHandler $userHandler;
        
        public function __construct(){
            $this->userHandler =  new UserHandler();
        }

        function login(){
            Env::startSession();
            if(!empty($_SESSION['user'])){
                $this->userHandler->logUserOut();
            }
            require_once(__DIR__."/../Pages/Login.php");
        }

        function logUserIn(){
            if($this->userHandler->logUserIn()){
                echo json_encode(['isUserLoggedIn'=>true]);
                return;
            } else {
                echo json_encode(['isUserLoggedIn'=>false]);
                return;
            }
        }

        function user(){
            if(empty($_SESSION['user'])){
                header("Location: /login"); 
            } else {
                require_once(__DIR__."/../Pages/UserWelcome.php");
            }
        }

        function createUser(){
            $_POST = json_decode(file_get_contents('php://input'),1);
            
            if($this->userHandler->registerUser()){
                echo json_encode(['userCreated'=>true]);
                return;
            } else {
                $captchaPhrase = "/".$_SESSION['captchaPhrase']."/";
                if(!preg_match($captchaPhrase,$_POST['captcha'])){
                    echo json_encode(['userCreated'=>"captcha_failed"]);
                    return;
                }
                echo json_encode(['userCreated'=>false]);
                return;
            }
        }

        function createUserForm(){
            $captchaBuilder = new Builder();
            $captchaBuilder->noiseFactor = 0;
            $captchaBuilder->maxLinesBehind = 1;
            $captchaBuilder->maxLinesFront = 0;
            $captchaBuilder->build(150,80);
            $captchaBuilder->distort = false;
            
            require_once(__DIR__."/../Pages/CreateUser.php");
            
            Env::startSession();
            $_SESSION['captchaPhrase'] = $captchaBuilder->phrase;
        }
        
    }
    