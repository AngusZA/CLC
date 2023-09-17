<?php
    namespace CLC\Handlers;

    use CLC\Entities\User;
    use CLC\Database\Database;
    use CLC\Env;

    class UserHandler 
    {
        private $database;
        public function __construct(
        )
        {
            $this->database = new Database();
            Env::startSession();
        }     

        public function logUserIn(){
            $_POST = json_decode(file_get_contents('php://input'),1);
            $password = $_POST['password'];
            if(!empty($_POST['user']) && !empty($_POST['password'])){
                $user = new User();
                $user->setUserName($_POST['user']['userName']);
            } else {
                return false;
            }
            $stmt = $this->database->pdoInstance->prepare("SELECT * FROM users WHERE userName=? LIMIT 1");
            $stmt->execute([$user->getUserName()]); 
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if($row && password_verify($password,$row['passwordHash'])){
                $this->LogUserOut();
                $user->setFirstName($row['firstName']);
                $user->setLastName($row['lastName']);
                $this->setSessionUser($user);
                return true;
            } else {
                return false;
            }
        }

        public function logUserOut() : bool {
            $this->setSessionUser(null);
            return true;
        }

        public function getLoggedInUser() : User {
            return $_SESSION['user'];
        }

        public function setSessionUser(?User $user){
            $_SESSION['user'] = $user;
        }

        public function registerUser(){
            Env::startSession();
            $_POST = json_decode(file_get_contents('php://input'),1);
            $captchaPhrase = "/".$_SESSION['captchaPhrase']."/";
            if(!preg_match($captchaPhrase,$_POST['captcha'])){
                return false;
            }

            $user = new User();
            $user->setFirstName($_POST['user']['firstName']);
            $user->setLastName($_POST['user']['lastName']);
            $user->setUserName($_POST['user']['userName']);

            $password = "";
            $password=$_POST['password'];

            if( empty($user->getFirstName()) 
                || 
                empty($user->getUserName()) 
                || 
                empty($password)
                || 
                !preg_match('/^(?=.*[A-Z])(?=.*[\W_]).{8,}$/',$password)
            ) return false;

            $stmt = $this->database->pdoInstance->prepare("INSERT INTO users (firstName,userName,passwordHash,lastName) value (?,?,?,?)");
            $passwordHash = password_hash($password,null);
            try {
                return($stmt->execute([
                    $user->getFirstName(),
                    $user->getUserName(),
                    $passwordHash,
                    $user->getLastName()
                ]));                
            } catch (\Throwable $th) {
                return false;
            }
        }
    }
    
    