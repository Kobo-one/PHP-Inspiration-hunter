<?php

    class Security{
        public $password;
        public $passwordConfirmation;
        public $currentPassword;
        public $userName;
        public $email;
        
        //check if passwords are secure to use in my signup process
        public function passwordsAreSecure(){
            if( $this->passwordIsStrongEnough() && $this->passwordsAreEqual() ){
                return true;
            }
            else {
                return false;
            }
        }
        
        private function passwordIsStrongEnough(){
            if( strlen( $this->password ) <= 8){
                return false;
            }
            else {
                return true;
            }
        }
        
        private function passwordsAreEqual(){
            if( $this->password == $this->passwordConfirmation){
                return true;
            }
            else {
                return false;
            }
        }
        
        public function emailValidate(){

            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                return true;
            }
        }
    

        public function currentPassword(){
            $conn = Db::getInstance();
            $user = new User();
            $statement = $conn->prepare("select * from users where id = :id");
            $statement->bindValue(":id", $user->loggedInUser());
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            if($result){
			
                if(password_verify($this->currentPassword, $result->password)){
                    return true;
                }
                else{
                    return false;                    
                }
            }
        }
        
        public function checkUserName(){
            $conn = Db::getInstance();
            $user = new User();
            $statement = $conn->prepare("select username from users where username = :username");
            $statement->bindValue(":username", $this->userName);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            
            if($result){
                return true;
            } else {
                return false;
            }
        }
        
        public function checkEmail(){
            $conn = Db::getInstance();
            $user = new User();
            $statement = $conn->prepare("select email from users where email = :email");
            $statement->bindValue(":email", $this->email);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            
            if($result){
                return true;
            } else {
                return false;
            }
        }
    }

?>