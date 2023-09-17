<?php
    namespace CLC\Database;

    use \PDO;

    class Database 
    {
        public PDO $pdoInstance;
        public function __construct(){
            $this->pdoInstance = new PDO(getenv("DSN"),getenv("DB_USER"),getenv("DB_PASSWORD"));
        }
    }
    