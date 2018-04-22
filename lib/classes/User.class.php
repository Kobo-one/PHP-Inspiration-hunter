<?php

    include_once("Db.class.php");

    class User {
        private $picture;
        private $firstName;
        private $lastName;
        private $userName;
        private $email;
        private $password;
        private $id;
        private $followStatus;
        
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
        
    public function setFollowStatus($followStatus)
    {
            $this->followStatus = $followStatus;

            return $this;
    }

    public function setPicture($picture)
    {
           $this->picture = $picture;

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
    
    public function getFollowStatus()
    {
            return $this->followStatus;
    }

    public function getPicture()
    {
             return $this->picture;
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
        throw new Exception("This username does not exist");
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

    public function loggedInUser(){
        $this->setEmail($_SESSION["username"]);
        $idArray = $this->getIdbyEmail();
        $id=$idArray->id;
        return $id;
    }

    //wanneer op follow-btn wordt geklikt-> nieuwe rij in tabel followers
    public function newFollow(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO followers(user_id,follower_id,status) VALUES (:userId, :followerId, :status)");
        $statement->bindValue(":userId", $this->loggedInUser());
        $statement->bindValue(":followerId", $this->getId());
        $statement->bindValue(":satus",$this->getFollowStatus());
        $statement->execute();
        
        
        return $statement;
    }
    
    //kijken of je de user al volgt, geeft aantal rijen terug. Als het geen rijen terug geeft -> volg je de user nog niet
    public function checkFollower(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM followers WHERE user_id=:id AND follower_id= :id2");
        $statement->bindValue(":id", $this->loggedInUser());
        $statement->bindValue(":id2", $this->getId());
        $statement->execute();
        $amount=$statement->rowCount();
        return $amount;
    }
    public function editUser(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, username = :username, picture = :picture WHERE id = :id");
        $statement->bindValue(":firstname", $this->getFirstName());
        $statement->bindValue(":lastname", $this->getLastName());
        $statement->bindValue(":username", $this->getUserName());
        $statement->bindValue(":picture", $this->getPicture());
        $statement->bindValue(":id", $this->loggedInUser());
        $result = $statement->execute();
        return $result;
    }
    
    public function editEmail(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE users SET email = :email WHERE id = :id");
        $statement->bindValue(":Email", $this->getEmail());
        $statement->bindValue(":id", $this->loggedInUser());
        $result = $statement->execute();
        return $result;
    }

}

?>
