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
        private $description;
        private $search;
        
        
    /*Setters*/
        
    public function setFirstName($firstName)
    {
            $this->firstName = $firstName;
            return $this;
    }
        
    public function setLastName($lastName)
    {
           $this->lastName = $lastName;
           return $this; 
    }   
        
    public function setUserName($userName)
    {
            $this->userName = $userName;
            return $this;
    }

        
    public function setEmail($email)
    {
          $this->email = $email;
          return $this;
    }

    public function setPassword($password)
    {
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

    public function setDescription($description)
    {
            $this->description = $description;

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
    public function getDescription()
    {
             return $this->description;
    }

     /**
     * Get the value of search
     */ 
    public function getSearch()
    {
           return $this->search;  
    }
    /**
     * Set the value of search
     *
     * @return  self
     */ 
    public function setSearch($search)
    {
        $this->search = strtolower($search."%");  
            return $this;
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
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
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
        $statement = $conn->prepare("SELECT * FROM `followers` WHERE follower_id = :id AND status=1");
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
        $id = $_SESSION["user"];
        return $id;
    }

    //wanneer op follow-btn wordt geklikt-> nieuwe rij in tabel followers
    public function newFollow(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO followers(user_id,follower_id,status) VALUES (:userId, :followerId, 1)");
        $statement->bindValue(":followerId", $this->loggedInUser());
        $statement->bindValue(":userId", $this->getId());
        $statement->execute();
        
        return $statement;
    }

    public function editFollow(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE followers SET status = :status WHERE user_id=:userId AND follower_id=:followerId ");
        $statement->bindValue(":followerId", $this->loggedInUser());
        $statement->bindValue(":userId", $this->getId());
        $statement->bindValue(":status",$this->getFollowStatus());
        $statement->execute();
        return $statement;
    }
    
    

    //kijken of je de user al volgt, geeft aantal rijen terug. Als het geen rijen terug geeft -> volg je de user nog niet
    public function checkFollower(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM followers WHERE user_id=:id AND follower_id= :id2 AND status=1");
        $statement->bindValue(":id2", $this->loggedInUser());
        $statement->bindValue(":id", $this->getId());
        $statement->execute();
        $amount=$statement->rowCount();;
        return $amount;
    }

    public function existFollow(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM followers WHERE user_id=:id AND follower_id= :id2");
        $statement->bindValue(":id2", $this->loggedInUser());
        $statement->bindValue(":id", $this->getId());
        $statement->execute();
        $amount=$statement->rowCount();
        return $amount;
    }
    


    public function editUser(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, username = :username, picture = :picture, description = :description WHERE id = :id");
        $statement->bindValue(":firstname", $this->getFirstName());
        $statement->bindValue(":lastname", $this->getLastName());
        $statement->bindValue(":username", $this->getUserName());
        $statement->bindValue(":picture", $this->getPicture());
        $statement->bindValue(":description", $this->getDescription());
        $statement->bindValue(":id", $this->loggedInUser());
        $result = $statement->execute();
        return $result;
    }
    
    public function editSecurity(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE users SET email = :email, password = :password WHERE id = :id");
        $statement->bindValue(":email", $this->getEmail());
        $statement->bindValue(":password", $this->getPassword());
        $statement->bindValue(":id", $this->loggedInUser());
        $result = $statement->execute();
        return $result;
    }

/* find friends name to live tag them*/   
    public function findUser(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT users.username FROM users, followers WHERE users.id= followers.user_id AND followers.follower_id=7 AND followers.user_id IN( SELECT users.id FROM users WHERE username LIKE :search)");
        $statement->bindValue(":search", $this->getSearch());
        
        $statement->execute();
        $result =$statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }


      
       
}

?>
