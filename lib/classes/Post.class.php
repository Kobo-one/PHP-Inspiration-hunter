<?php
include_once("Db.class.php");

class Post{
  private $image;
  private $description;
  private $userId;
  private $created;
  private $deleted;


  /**
   * Get the value of image
   */ 
  public function getImage()
  {
    return $this->image;
  }

  /**
   * Set the value of image
   *
   * @return  self
   */ 
  public function setImage($image)
  {
    $this->image = $image;

    return $this;
  }

  /**
   * Get the value of description
   */ 
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set the value of description
   *
   * @return  self
   */ 
  public function setDescription($description)
  {
    $this->description = $description;

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
   * Get the value of created
   */ 
  public function getCreated()
  {
    return $this->created;
  }

  /**
   * Set the value of created
   *
   * @return  self
   */ 
  public function setCreated($created)
  {
    $this->created = $created;

    return $this;
  }

  /**
   * Get the value of deleted
   */ 
  public function getDeleted()
  {
    return $this->deleted;
  }

  /**
   * Set the value of deleted
   *
   * @return  self
   */ 
  public function setDeleted($deleted)
  {
    $this->deleted = $deleted;

    return $this;
  }



  public static function getAll(){
    $conn = Db::getInstance();
    $statement= $conn->prepare('SELECT posts.*, user.firstname, user.lastname, user.picture FROM posts, user WHERE posts.post_user_id = user.id ');
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
/* 
  public static function getTag(){
    $conn = Db::getInstance();
    $statement= $conn->prepare('SELECT * FROM posts WHERE ');
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  */
}




 ?>
