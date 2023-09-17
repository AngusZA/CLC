<?php
    namespace CLC\Entities;

    class User 
    {
        private ?string $firstName;   
        private ?string $lastName;
        private string $userName;
                
        /**
         * Get the value of userName
         */ 
        public function getUserName()
        {
                return $this->userName;
        }

        /**
         * Set the value of userName
         *
         * @return  self
         */ 
        public function setUserName($userName)
        {
                $this->userName = $userName;

                return $this;
        }


        /**
         * Get the value of lastName
         */ 
        public function getLastName()
        {
                return $this->lastName;
        }

        /**
         * Set the value of lastName
         *
         * @return  self
         */ 
        public function setLastName($lastName)
        {
                $this->lastName = $lastName;

                return $this;
        }

        /**
         * Get the value of firstName
         */ 
        public function getFirstName()
        {
                return $this->firstName;
        }

        /**
         * Set the value of firstName
         *
         * @return  self
         */ 
        public function setFirstName($firstName)
        {
                $this->firstName = $firstName;

                return $this;
        }
    }   

?>