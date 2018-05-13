<?php
include_once("Db.class.php");
include_once("Image.class.php");

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
  private $tags;
  private $filter;
  private $limit;
  

//privates for the geolocation
  private $lat;
  private $lng;


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
    $this->click = $click *20;
    //HIER NOG MAAL 20 ;

    return $this;
  }


  /**
   * Get the value of lat
   */ 
  public function getLat()
  {
    return $this->lat;
  }

  /**
   * Set the value of lat
   *
   * @return  self
   */ 
  public function setLat($lat)
  {
    $this->lat = $lat;

    return $this;
  }
  
  /**
   * Get the value of lng
   */ 
  public function getLng()
  {
    return $this->lng;
  }

  /**
   * Set the value of lng
   *
   * @return  self
   */ 
  public function setLng($lng)
  {
    $this->lng = $lng;

    return $this;
  }

  
  /**
   * Get the value of filter
   */ 
  public function getFilter()
  {
    return $this->filter;
  }

  /**
   * Set the value of filter
   *
   * @return  self
   */ 
  public function setFilter($filter)
  {
    $this->filter = $filter;

    return $this;
  }


  /**
   * Get the value of limit
   */ 
  public function getLimit()
  {
    return $this->limit;
  }

  /**
   * Set the value of limit
   *
   * @return  self
   */ 
  public function setLimit($limit)
  {
    $this->limit = $limit;

    return $this;
  }
    
  public function getFollowStatus()
    {
            return $this->followStatus;
    }
    
  public function setFollowStatus($followStatus)
    {
            $this->followStatus = $followStatus;
            return $this;
            
    }

      
    public function setTags($string) {
  
      /* Match hashtags */
      preg_match_all('/#(\w+)/', $string, $matches);
      
      /* Add all matches to array */
      foreach ($matches[1] as $match) {
        $keywords[] = $match;
        }
      $this->tags = (array)$keywords;
      return $this;
    }
    
    public function getTags()
    {
      return $this->tags;
    }


    /*Upload nieuwe foto met beschrijving*/
    public function createPost(){
    $conn = Db::getInstance();
    $statement = $conn->prepare("INSERT INTO posts (image, description, filter, post_user_id, lat, lng) VALUES(:image, :description, :filter, :user, :lat, :lng)");
    $statement->bindValue(":image", $this->getImage());
    $statement->bindValue(":description", $this->getDescription());
    $statement->bindValue(":filter", $this->getFilter());
    $statement->bindValue(":user", $_SESSION['user']);
    $statement->bindValue(":lat", $this->getLat());  
    $statement->bindValue(":lng", $this->getLng());    
    $image_upload = $statement->execute();
    $this->setIdG($conn->lastInsertId());
    $this->storeTags();
    return $image_upload;
    }
    
    /*Update beschrijving eigen post*/
    public function editPost(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE posts SET description = :description WHERE id = :id AND post_user_id = :user");
        $statement->bindValue(":description", $this->getDescription());
        $statement->bindValue(":id", $this->getIdG());
        $statement->bindValue(":user", $_SESSION['user']); 
        $result = $statement->execute();
        return $result;
    }
    
    /*Delete eigen post*/
    public function deletePost(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE posts SET deleted = 1 WHERE id = :id AND post_user_id = :user");
        $statement->bindValue(":id", $this->getIdG());
        $statement->bindValue(":user", $_SESSION['user']); 
        $result = $statement->execute();
        return $result;
    }

/* tel aantal likes per post, sorteer op meeste likes en geef id van 20 meest gelikete posts terug*/
public static function countTopPosts(){
  $conn = Db::getInstance();
  $statement = $conn->prepare("SELECT post_id, count(*) AS c FROM likes group by post_id order by c desc LIMIT 20");
  $statement->execute();
  $result=$statement->fetchAll(PDO::FETCH_ASSOC);
  $array=[];
  foreach($result as $r){
    array_push($array,intval($r['post_id']));
  }
  return $array;
}

/* Als je nog geen vrienden hebt -> toon posts met meeste likes. 
(select alles uit posts en de username en profielfoto van de posts met id uit countTopPosts)*/
public static function getTopPosts(){
  $array= Post::countTopPosts();
  $conn = Db::getInstance();
  $in = '(' . implode(',', $array) .')';

  $statement = $conn->prepare("SELECT posts.*, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND posts.deleted = 0 AND posts.id IN $in LIMIT 20 ");
  $statement->execute();
  $result=$statement->fetchAll(PDO::FETCH_ASSOC);
 
  return $result;
}


 

/* select posts, date without seconds. show only posts from friends and hashtags you follow*/  

  public static function allPost($limit){
    $conn = Db::getInstance();
    $statement=$conn->prepare("SELECT posts.*, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND posts.deleted = 0 AND (
    (users.id IN (SELECT followers.user_id FROM followers WHERE followers.status=1 AND followers.follower_id =:user))
    OR(posts.id IN (SELECT post_tag.post_id FROM post_tag WHERE post_tag.tag_id IN( SELECT follower_tag.tag_id FROM follower_tag WHERE follower_tag.follower_id=:user AND follower_tag.status=1))
    )) ORDER BY posts.created DESC LIMIT :limit");
    $statement->bindValue(':user', $_SESSION["user"], PDO::PARAM_INT);  
    $statement->bindValue(':limit', $limit,PDO::PARAM_INT);  
  
    $statement->execute();
    return $statement;
  }  

  public static function getAll($lim){
      $statement = Post::allPost($lim);
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    
    }

/*  Zoek in description of op username */  
  public function getTag(){
    $conn = Db::getInstance();
    /*$statement= $conn->prepare("SELECT posts.*, users.username, users.picture FROM posts, users, post_tag, tags WHERE post_tag.tag_id=tags.id AND posts.id = post_tag.post_id AND posts.post_user_id = users.id AND lower(tags.tag) LIKE :search UNION SELECT posts.*, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND lower(users.username) LIKE :search ");*/
    $statement= $conn->prepare("SELECT posts.*, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND posts.deleted = 0 AND (lower(users.username) LIKE :search OR lower(posts.description) LIKE :search)");
   
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
    $statement= $conn->prepare("SELECT posts.*, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND posts.deleted = 0 AND posts.id = :search");
    $searchV=$this->getIdG();
    $statement->bindParam(':search', $searchV, PDO::PARAM_INT );
    
    $statement->execute();
    
    
    return $statement->fetchAll(PDO::FETCH_ASSOC);
    
  }

  /* Laad profiel details*/ 
  public function DetailsProfile(){
    $conn = Db::getInstance();
    $statement= $conn->prepare("SELECT posts.*, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND posts.deleted = 0 AND posts.post_user_id= :search ORDER BY posts.created DESC ");
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
    $statement=$conn->prepare("SELECT posts.*, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND posts.deleted = 0 AND (
    (users.id IN (SELECT followers.user_id FROM followers WHERE followers.status=1 AND followers.follower_id =:user))
    OR(posts.id IN (SELECT post_tag.post_id FROM post_tag WHERE post_tag.tag_id IN( SELECT follower_tag.tag_id FROM follower_tag WHERE follower_tag.follower_id=:user AND follower_tag.status=1))
    )) ORDER BY posts.created DESC LIMIT :nr1, :nr2 ");
    $number1= $this->getClick()+1;
    $number2= $this->getClick()+21;
    
    $statement->bindValue(':nr1', $number1, PDO::PARAM_INT);  
    $statement->bindValue(':nr2', $number2, PDO::PARAM_INT);  
    $statement->bindValue(':user', $_SESSION["user"]);  
   
    $statement->execute();
    return $statement;
  }

      //inappropriate


      public function userFlagged(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM inappropriate WHERE post_id = :post_id AND user_id = :user ");
        $statement->bindValue(':user', $_SESSION['user']);
        $statement->bindValue(':post_id', $this->getIdG());
        $statement->execute();
        $result=$statement->rowcount();
        return $result; 
    }

    public function newInappropriate(){
      $conn = Db::getInstance();
          $statement= $conn->prepare("INSERT INTO inappropriate (user_id, post_id) VALUES(:user, (SELECT posts.id FROM posts WHERE posts.id=:post_id))");
          $statement->bindValue(':user', $_SESSION['user']);
          $statement->bindValue(':post_id', $this->getIdG()); 
          $result = $statement->execute();
          $this->inappropriateCheck();
          return $result; 
      }
      public function delInappropriate(){
      $conn = Db::getInstance();
          $statement= $conn->prepare("DELETE FROM inappropriate WHERE post_id = :post_id AND user_id = :user");
          $statement->bindValue(':user', $_SESSION['user']);
          $statement->bindValue(':post_id', $this->getIdG()); 
          $result = $statement->execute();
          $this->inappropriateCheck();
          return $result; 
    }

        public function inappropriateCheck(){
          $conn = Db::getInstance();
          $statement= $conn->prepare("SELECT * FROM inappropriate WHERE post_id = :post_id");
          $statement->bindValue(':post_id', $this->getIdG()); 
          $statement-> execute();
          $count = $statement->rowCount(); 
          
          if($count>=3){
            $this->setInappropriate(1);
            return false;
          }else{
            $this->setInappropriate(0);
            return true;
          }
        }

        public function setInappropriate($status){
          
          $conn = Db::getInstance();
          $statement= $conn->prepare("UPDATE posts SET deleted = :status WHERE id=:post_id");
          $statement->bindValue(":status",$status);
          $statement->bindValue(":post_id",$this->getIdG());
          return $statement-> execute();
        }

        public function saveTags(){
                $conn = Db::getInstance();
                $tags = $this->getTags();
                $statement= $conn->prepare("INSERT INTO tags (tag) VALUES(:tag)");
                foreach ($tags as $tag) {
                  $statement->bindValue(':tag', $tag);
                  $tags_added = $statement -> execute();
                }
              return $tags_added; 
             }

        public function storeTags(){
            $conn = Db::getInstance();
            $tags = $this->getTags();
            if(!empty($tags)){
            $statement= $conn->prepare("INSERT INTO post_tag (post_id,tag_id) VALUES(:post, :tag)");
            $statement->bindValue(':post', $this->getIdG());
            
            foreach ($tags as $tag) {
              $tagId=$this->getTagid($tag);
              $statement->bindValue(':tag', $tagId);
              $statement->execute();
          }
          }
            
            return true; 
          }

          public function getTagid($tag){
            $conn = Db::getInstance();
            $statement= $conn->prepare("SELECT id FROM tags WHERE tag LIKE :tag");
            $statement->bindValue(':tag',$tag );
            $result = $statement->execute();
            $id = $statement->fetch(PDO::FETCH_ASSOC);
            return $id["id"];
          }


       public static function convertHashtoLink($string)  
       {  
           $expression = "/#+([a-zA-Z0-9_]+)/";  
          $string = preg_replace($expression, '<a href="search.php?search=$1">$0</a>', $string);  
          return $string;  
      } 
    
        /*Check of zoekterm een hashtag is*/
        public function searchForHashTag(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT tag FROM tags WHERE tag LIKE :search ");
            $statement->bindValue(':search', $this->getSearch());  
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } 
    
        //wanneer op follow-btn wordt geklikt-> nieuwe rij in tabel follower_tag
        public function newFollow(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO follower_tag(follower_id,tag_id,status) VALUES (:followerId, :tagId, 1)");
            $statement->bindValue(':followerId', $_SESSION['user']);
            $statement->bindValue(':tagId', $this->getTagid($this->getSearch()));
            return $statement->execute();
            //return $statement;
        }

    
        public function editFollow(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE follower_tag SET status = :status WHERE tag_id=:tagId AND follower_id=:followerId ");
            $statement->bindValue(':followerId', $_SESSION['user']);
            $statement->bindValue(':tagId', $this->getTagid($this->getSearch()));
            $statement->bindValue(':status',$this->getFollowStatus());
            return $statement->execute();
            //return $statement;
            
            
        }
    
        //kijken of je de hashtag al volgt, geeft aantal rijen terug. Als het geen rijen terug geeft -> volg je de hashtag nog niet
        public function checkFollower(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM follower_tag WHERE tag_id=:tagId AND follower_id= :followerId AND status=1");
            $statement->bindValue(':tagId', $this->getTagid($this->getSearch()));
            $statement->bindValue(':followerId', $_SESSION['user']);
            $statement->execute();
            $amount=$statement->rowCount();;
            return $amount;
        }
    
        public function existFollow(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM follower_tag WHERE tag_id=:tagId AND follower_id= :followerId");
            $statement->bindValue(':tagId', $this->getTagid($this->getSearch()));
            $statement->bindValue(':followerId', $_SESSION['user']);
            $statement->execute();
            $amount=$statement->rowCount();
            return $amount;
        }
    
        public function Followers(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM follower_tag WHERE follower_id = :id AND status=1");
            $statement->bindValue(":id", $_SESSION['user']);
            $statement->execute();
            return $statement;
        }

        public function GetFollowers(){
            $statement = $this->Followers();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            return $result;
        }
        


 
  public static function timeAgo($pTime){
      // tijdzone veranderen naar brusselse
      date_default_timezone_set("Europe/Brussels");
      
      $postTime = new DateTime($pTime);
      $currentTime = new DateTime();
      //verschil tussen timestamp post en current time
      $interval = $currentTime->diff($postTime);

      if ($interval->h==0  && $interval->d==0 && $interval->m==0 && $interval->y==0){
          return $interval->format('%i minute(s) ago')."\n";
      }
      if ($interval->d==0 && $interval->m==0 && $interval->y==0){
          return $interval->format('%h hour(s) ago')."\n";
      }
      if($interval->m==0 && $interval->y==0){
          return $interval->format('%a day(s) ago')."\n";
      }
      if($interval->y==0){
          return $interval->format('%m month(s) ago');
      }
      if($interval->y>=1){
          return $interval->format('%y year(s) ago');
      }
  }

  public static function setCities($collection){
      $newcollection = array();
        foreach($collection as $key =>$c){
          $newcollection[$key] = $c;
            $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$c['lat'].','.$c['lng'].'&sensor=false';
            $json = @file_get_contents($url);
            $data = json_decode($json);
            $status = $data->status;
            
            //if request status is successful
            if($status == "OK"){
                //get address from json data
                $location = $data->results[0]->address_components[2]->long_name;
            }else{
                $location =  'Unknown';
            }
            $newcollection[$key]["city"] = $location;
        }
        return $newcollection;
  }
    
   /*Get the locations within the radius of a certain location*/
    public function getLocationsInRadius($lng, $lat){
    $radius = 30 * 0.62137;

    $url = 'http://gd.geobytes.com/GetNearbyCities?radius='.$radius.'&Latitude='.$lat.'&Longitude='.$lng.'&limit=999';

    $response_json = file_get_contents($url);

    $response = json_decode($response_json, true);
    /*var_dump($response);*/
    return $response;
    }
    
    
    /*Get all the posts out of database to compare locations*/
    public function getLocation(){
        $conn = Db::getInstance();
        $statement= $conn->prepare("SELECT posts.*, users.username, users.picture FROM posts, users WHERE posts.post_user_id = users.id AND posts.deleted = 0 ");
        $statement->execute();
        
    return $statement->fetchAll(PDO::FETCH_ASSOC);
        
    } 
    






  

}




 ?>
