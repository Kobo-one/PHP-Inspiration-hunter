<?php
include_once("Db.class.php");

class Post{
  private $image;
  private $description;
  private $userId;
  private $created;
  private $deleted;
  private $search;

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

   /**
   * Get the value of search
   */ 
  public function getSearch()
  {
     var_dump($this->search);
    return $this->search;
  }

  /**
   * Set the value of search
   *
   * @return  self
   */ 
  public function setSearch($search)
  {
    $this->search = strtolower($search);
   ;
    return $this;
  }

    public function createPost(){
    $conn = Db::getInstance();
    $statement = $conn->prepare("INSERT INTO posts (image, description, post_user_id) VALUES(:image, :description, (SELECT users.id FROM users WHERE users.email=:email))");
    $statement->bindValue(":image", $this->getImage());
    $statement->bindValue(":description", $this->getDescription());
    $statement->bindValue(":email", $_SESSION['username']);    
    $image_upload = $statement->execute();
    return $image_upload;
    }


  public static function getAll(){
    $conn = Db::getInstance();
    $statement= $conn->prepare("SELECT posts.*, DATE_FORMAT(posts.created, '%Y-%m-%d %H:%i') AS date, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id ");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
   
  }

  public function getTag(){
    $conn = Db::getInstance();
    $statement= $conn->prepare("SELECT posts.*, users.username, users.picture FROM posts, users, post_tag, tags WHERE post_tag.tag_id=tags.id AND posts.id = post_tag.post_id AND posts.post_user_id = users.id AND lower(tags.tag) LIKE '%:search%' UNION SELECT posts.*, users.firstname, users.lastname, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND lower(posts.description) LIKE '%:search%'  ");
    $statement->bindValue(':search', $this->getSearch() );
    $statement->execute();
    //$statement->rowCount(); 
   

    return $statement->fetchAll(PDO::FETCH_ASSOC);
    
  }

  public function getDetailsPost(){
    $conn = Db::getInstance();
    $statement= $conn->prepare("SELECT posts.*, DATE_FORMAT(posts.created, '%Y-%m-%d %H:%i') AS date, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND posts.id = :search  ");
    $statement->bindValue(':search', $this->getSearch() );
    $statement->execute();
    

    return $statement->fetchAll(PDO::FETCH_ASSOC);
    
  }
  
  public function getDetailsProfile(){
    $conn = Db::getInstance();
    $statement= $conn->prepare("SELECT posts.*, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND posts.post_user_id= :search  ");
    $statement->bindValue(':search', $this->getSearch() );
    $statement->execute();
    

    return $statement->fetchAll(PDO::FETCH_ASSOC);
    
  }

 

 
}




 ?>
