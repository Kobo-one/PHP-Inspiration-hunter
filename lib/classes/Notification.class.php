<?php
include_once("Db.class.php");

class Notification
{
    private $tagged;
    private $postId;



    /**
     * Get the value of tagged
     */ 
    public function getTagged()
    {
        return $this->tagged;
    }

    /**
     * Set the value of tagged
     *
     * @return  self
     */ 
    public function setTagged($tagged)
    {
        $this->tagged = $tagged;

        return $this;
    }

    /**
     * Get the value of postId
     */ 
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set the value of postId
     *
     * @return  self
     */ 
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    public function saveNotif(){
        $conn = Db::getInstance();
        $statement= $conn->prepare("INSERT INTO notifications(post_id, user_id,tagged_id) VALUES (:postId,:user,:tagged)");
        $statement->bindValue(':tagged', $this->findUser());
        $statement->bindValue(':user', $_SESSION["user"], PDO::PARAM_INT);
        $statement->bindValue(':postId', $this->getPostId(), PDO::PARAM_INT); 
        $statement->execute();
    
        return $statement->execute();
    }

    public function findUser(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM users WHERE lower(username)=lower(:tagged)");
        $statement->bindValue(':tagged', $this->getTagged());

        $statement->execute();

        return $statement->fetchColumn();
    }
   
}