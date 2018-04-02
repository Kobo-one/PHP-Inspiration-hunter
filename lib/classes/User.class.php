<?php

    include_once("Db.class.php");

    class User {
        private $firstName;
        private $lastName;
        private $userName;
        private $email;
        private $password;
        private $id;
        
    /*Setters*/
        
    public function setFirstName($firstName)
    {
        if(empty($firstName)){
            throw new Exception("Please fill in your firstname.");
        }
            $this->firstName = $firstName;
            return $this;
    }
        
    public function setLastName($lastName)
    {
        if(empty($lastName)){
            throw new Exception("Please fill in your lastname.");
        }
        $this->lastName = $lastName;
        return $this;
    }   
        
    public function setUserName($userName)
    {
        if(empty($userName)){
            throw new Exception("Please fill in a username.");
        }
        $this->userName = $userName;
        return $this;
    }

        
    public function setEmail($email)
    {
      if(empty($email)){
            throw new Exception("Please fill in your e-mail.");
      }
        $this->email = $email;
        return $this;
    }

    public function setPassword($password)
    {
        if(empty($password)){
            throw new Exception("Please fill in a password.");
        }
        $this->password = $password;
        return $this;
    }
    
    public function setId($id)
    {
            $this->id = $id;

            return $this;
    }
        

    /*Getters*/
    
    public function getFirstName()
    {
        return $this->firstName;
    }
        
    public function getLastName()
    {
        return $this->lastName;
    }
        
        public function getUserName()
    {
        return $this->userName;
    }
        
    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
    
    public function getId()
    {
            return $this->id;
    }
        
    //register new user
    public function register() 
    {
        $conn = Db::getInstance();
            
        $statement = $conn->prepare("insert into users (firstname, lastname, username, email, password) values (:firstName, :lastName, :userName, :email, :password)");
            
        $hash = password_hash($this->password, PASSWORD_BCRYPT);
        $statement->bindValue(":firstName", $this->getFirstName());
        $statement->bindValue(":lastName", $this->getLastName());
        $statement->bindValue(":userName", $this->getUserName());
        $statement->bindValue(":email", $this->getEmail());
        $statement->bindParam(":password", $hash);
                
        $result = $statement->execute();
            
        return $result;
            
    }

    
      public function login() 
    {
        $conn = Db::getInstance();
            
        $statement = $conn->prepare("select * from users where email = :email");
        $statement->bindValue(":email", $this->getEmail());
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        if($result){
			
			if(password_verify($this->password, $result->password)){
				return true;
            }
            else{
                //return false;
                throw new Exception("Password incorrect");
             }
        }
    
    else{
        throw new Exception("Login failed");
        return false;
    }
        
        
        
    }

    public function getIdbyEmail(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT id FROM `users` WHERE email = :email");
        $statement->bindValue(":email", $this->getEmail());
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        
        return $result;
    }


    public function getDetails(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM `users` WHERE id = :id");
        $statement->bindValue(":id", $this->getId());
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        
        return $result;

    }

    public function Followers(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM `followers` WHERE user_id= :id");
        $statement->bindValue(":id", $this->getId());
        $statement->execute();
        
        return $statement;
    }

    public function GetFollowers(){
        $statement = $this->Followers();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getFollowersAmount(){
        $statement = $this->Followers();
        $amount=$statement->rowCount();
        return $amount;
        
    }
}

?>
