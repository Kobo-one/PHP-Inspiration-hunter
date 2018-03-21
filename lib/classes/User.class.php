<?php

    class User {
        private $firstName;
        private $lastName;
        private $email;
        private $password;
        
    /*Setters*/
        
    public function setFirstName($firstName)
    {
        if(empty($firstName)){
            throw new Exception ("Please fill in your firstname.");
        }
            $this->firstName = $firstName;
            return $this;
    }
        
    public function setLastName($lastName)
    {
        if(empty($lastName)){
            throw new Exception ("Please fill in your lastname.");
        }
        $this->lastName = $lastName;
        return $this;
    }   
        
    public function setEmail($email)
    {
      if(empty($email)){
        throw new Exception ("Please fill in your e-mail.");
      }
        $this->email = $email;
        return $this;
    }

    public function setPassword($password)
    {
        if(empty($password)){
            throw new Exception ("Please fill in a password.");
        }
        $this->password = $password;
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
        
    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function register() 
    {
        $conn = Db::getInstance();
            
        $statement = $conn->prepare("insert into users (firstname, lastname, email, password) values (:firstName, :lastName, :email, :password)");
            
        $hash = password_hash($this->password, PASSWORD_BCRYPT);
        $statement->bindParam(":firstName", $this->firstName);
        $statement->bindParam(":lastName", $this->lastName);
        $statement->bindParam(":email", $this->email);
        $statement->bindParam(":password", $hash);
                
        $result = $statement->execute();
            
        return $result;
            
    }
        
        
        
    }


?>
