<?php
include_once("Db.class.php");

class Notification
{
    private $tagged;
    private $postId;
    private $userId;
    private $date;
    

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
     /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function saveNotif(){
        $conn = Db::getInstance();
        $statement= $conn->prepare("INSERT INTO notifications(post_id, user_id,tagged_id) VALUES (:postId,:user,:tagged)");
        $statement->bindValue(':tagged', $this->findUser());
        $statement->bindValue(':user',$_SESSION['user'], PDO::PARAM_INT);
        $statement->bindValue(':postId', $this->getPostId()); 
    
        return $statement->execute();
    }

    public function findUser(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT id FROM users WHERE lower(username)=lower(:tagged)");
        $statement->bindValue(':tagged', $this->getTagged());
        $statement->execute();
        return $statement->fetchColumn();
    }

    public static function getUnseen(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT notifications.*, users.username, users.id AS userId, users.picture FROM notifications, users WHERE users.id = notifications.user_id AND notifications.tagged_id=:user AND seen=0 ");
        $statement->bindValue(':user',$_SESSION['user'], PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getAllNf(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT notifications.*, users.username, users.id AS userId, users.picture FROM notifications, users WHERE users.id = notifications.user_id AND notifications.tagged_id=:user GROUP BY notifications.date DESC ");
        $statement->bindValue(':user',$_SESSION['user'], PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setToSeen(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE notifications SET seen=1 WHERE tagged_id=:user AND date<:date");
        $statement->bindValue(':user',$_SESSION['user'], PDO::PARAM_INT);
        $statement->bindValue(':date',$this->getDate());
        $statement->execute();
    }
     
   
   

   

}