<?php

    class Security{
        public $password;
        public $passwordConfirmation;
        public $currentPassword;
        
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
        
        
    }

?>