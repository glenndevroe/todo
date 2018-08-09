<?php 
    class User {
        private $email;
        private $password;
        private $username;
        private $db;

        public function __construct($db){
            $this->db = $db;
        }

         
        public function getUsername()
        {
                return $this->username;
        }

    
        public function setUsername($username)
        {
            if( empty($username) ){
                throw new Exception("Username cannot be empty");
            }
            
            $this->username = $username;
            return $this;
    
            
        }
        
        public function getPassword(){
    
        }

        public function setPassword(){

        }

        public function getEmail(){

        }

        public function setEmail($email){
            if( empty($email) ){
                throw new Exception("Email cannot be empty");
            }
            
            $this->email = $email;
            return $this;
    
            //todo: valid email? -> filter_var();
        }

        public function canIregister(){
            $stm = $this->db->prepare("SELECT * FROM studenten WHERE (username=:username or email=:email)");
            $stm->bindParam(":username", $this->username);
            $stm->bindParam(":email", $this->email);
            $result = $stm->execute();
            $user = $stm->fetch(PDO::FETCH_ASSOC);
            
            if($user['username'] == $this->username){
                throw new Exception('Username already exists. Please choose a different username.');
            } else if($this->email == $user['email']) {
                throw new Exception('Email already exists. Please choose a different username.');
            }
        }
        
        public function register($hash){
            
            $stm = $this->db->prepare("INSERT INTO studenten (username, email, password) values (:username, :email, :password)");
            
            $stm->bindParam(":username", $this->username);
            $stm->bindParam(":email", $this->email);
            $stm->bindParam(":password", $hash);
            
            //execute
            $result = $stm->execute();
            
            //antwoord geven
            return $result;
        }
        
        public function login(){
            session_start();
            $_SESSION['username'] = $this->username;
            header("Location: index.php");
        }

        public function canIlogin($pw){
            $stm = $this->db->prepare("SELECT * FROM studenten WHERE username = :username");
            $stm->bindParam(":username", $this->username);
            $result = $stm->execute();
            $user = $stm->fetch(PDO::FETCH_ASSOC);
            
            if(!empty($user)){
                if(password_verify($pw, $user['password']) ){
                    return true;
                    
                } else {
                    throw new Exception("Password is invalid. Please try again.");
                }

            } else {
                throw new Exception("Username is invalid. Please try again.");
            }
        }
        
    }


?>