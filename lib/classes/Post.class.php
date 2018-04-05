<?php
include_once("Db.class.php");

class Post{
  private $image;
  private $description;
  private $userId;
  private $created;
  private $deleted;
  private $search;
  private $comment;
  private $idG;
  private $click;


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
    
    return $this->search;
  }

  /**
   * Set the value of search
   *
   * @return  self
   */ 
  public function setSearch($search)
  {
    $this->search = strtolower("%".$search."%");
   ;
    return $this;
  }

   /**
   * Get the value of comment
   */ 
  public function getComment()
  {
    
    return $this->comment;
  }

  /**
   * Set the value of comment
   *
   * @return  self
   */ 
  public function setComment($comment)
  {
    $this->comment = $comment;

    return $this;
  }


  /**
   * Get the value of idG
   */ 
  public function getIdG()
  {
    return $this->idG;
  }

  /**
   * Set the value of idG
   *
   * @return  self
   */ 
  public function setIdG($idG)
  {
    $this->idG = $idG;

    return $this;
  }

  /**
   * Get the value of click
   */ 
  public function getClick()
  {
   
    return $this->click;
  }

  /**
   * Set the value of click
   *
   * @return  self
   */ 
  public function setClick($click)
  {
    $this->click = $click;
    //HIER NOG MAAL 20 ;

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

/* select posts, date without seconds. show only posts from friends*/  
  public static function getAll(){
    $conn = Db::getInstance();
    /*$statement= $conn->prepare("SELECT posts.*, DATE_FORMAT(posts.created, '%Y-%m-%d %H:%i') AS date, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id ");*/
    $statement=$conn->prepare("SELECT posts.*, DATE_FORMAT(posts.created, '%Y-%m-%d %H:%i') AS date, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND users.email IN (SELECT users.email FROM users,followers WHERE users.id = followers.follower_id AND followers.status=1 AND followers.user_id= (SELECT followers.user_id FROM followers, users WHERE followers.user_id=users.id AND users.email=:email LIMIT 1))LIMIT 20");
    $statement->bindValue(':email', $_SESSION["username"]);  
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
   
  }

/* search on tag or in description; select post:all and username +profilepic
 search convert to  lowercase. Search in entire db*/  
  public function getTag(){
    $conn = Db::getInstance();
    $statement= $conn->prepare("SELECT posts.*, users.username, users.picture,DATE_FORMAT(posts.created, '%Y-%m-%d %H:%i') AS date FROM posts, users, post_tag, tags WHERE post_tag.tag_id=tags.id AND posts.id = post_tag.post_id AND posts.post_user_id = users.id AND lower(tags.tag) LIKE :search UNION SELECT posts.*, users.username, users.picture, DATE_FORMAT(posts.created, '%Y-%m-%d %H:%i') AS date FROM posts, users WHERE posts.post_user_id = users.id AND lower(posts.description) LIKE :search ");
   
    $statement->bindValue(':search', $this->getSearch());  
    $statement->execute();
    
    // if there are no search results-> throw error
    if($statement->rowCount()<1){
      throw new Exception("No search results");
    }
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  /* When click on post -> go to details of post with date, description,...*/ 
  public function getDetailsPost(){
    $conn = Db::getInstance(); 
    $statement= $conn->prepare("SELECT posts.*, DATE_FORMAT(posts.created, '%Y-%m-%d %H:%i') AS date, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND posts.id = :search  ");
    $searchV=$this->getIdG();
    $statement->bindParam(':search', $searchV, PDO::PARAM_INT );
    
    $statement->execute();
    
    
    return $statement->fetchAll(PDO::FETCH_ASSOC);
    
  }

  /* Laad profiel details*/ 
  public function DetailsProfile(){
    $conn = Db::getInstance();
    $statement= $conn->prepare("SELECT posts.*, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND posts.post_user_id= :search  ");
    $statement->bindValue(':search', $this->getIdG(), PDO::PARAM_INT );
    $statement->execute();
    return $statement;

  }
  /* When you click on someone's profile -> go to that profile*/ 
  public function getDetailsProfile(){
    $statement= $this->DetailsProfile();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
    
  }

  /* Telt hoeveel posts de user heeft. */
  public function getProfilePostAmount(){
    $statement = $this->DetailsProfile();
    $amount=$statement->rowCount();
    return $amount;
  }

 /* When you go to details of post, show comments (from db) */
  public function getCommentsPost(){
    $conn = Db::getInstance();
    $statement= $conn->prepare("SELECT users.username, comments.comment FROM users, comments WHERE comments.user_id = users.id AND comments.post_id= :comment  ");
    $statement->bindValue(':comment', $this->getComment() );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
    
  }

  /* Load 20 more when button clicked */
  public function loadMore(){
    $conn = Db::getInstance();
    $statement=$conn->prepare("SELECT posts.*, DATE_FORMAT(posts.created, '%Y-%m-%d %H:%i') AS date, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND users.email IN (SELECT users.email FROM users,followers WHERE users.id = followers.follower_id AND followers.status=1 AND followers.user_id= (SELECT followers.user_id FROM followers, users WHERE followers.user_id=users.id AND users.email=:email LIMIT 1) )LIMIT :nr1, :nr2 ");
    $number1= $this->getClick();
    $number2= $this->getClick()*2;
    
    $statement->bindValue(':nr1', $number1, PDO::PARAM_INT);  
    $statement->bindValue(':nr2', $number2, PDO::PARAM_INT);  
     //FIX DEES :)
    $statement->bindValue(':email', $_SESSION["username"]);  
   
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

 

 






  
}




 ?>
