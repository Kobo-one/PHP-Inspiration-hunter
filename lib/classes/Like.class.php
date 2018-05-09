<?php
include_once("Db.class.php");
class Like
{
    private $postId;

    /* Setters */

    
    public function setPostId($postId)
	{
		$this->postId = $postId;
		return $this;
	}
    
	/* Getters */ 

    public function getPostId()
	{
		return $this->postId;
	}

    /* Save likes in database */
	public function newLike(){
		$conn = Db::getInstance();
        $statement= $conn->prepare("INSERT INTO likes (user_id, post_id) VALUES(:user, (SELECT posts.id FROM posts WHERE posts.id=:post_id))");
        $statement->bindValue(':user', $_SESSION['user']);
        $statement->bindValue(':post_id', $this->getPostId()); 
        $result = $statement->execute();
        return $result; 
    }
    public function delLike(){
		$conn = Db::getInstance();
        $statement= $conn->prepare("DELETE FROM likes WHERE post_id = :post_id AND user_id = :user");
        $statement->bindValue(':user', $_SESSION['user']);
        $statement->bindValue(':post_id', $this->getPostId()); 
        $result = $statement->execute();
        return $result; 
	}

    /* count the likes */
        
    
    public static function countLikes($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM likes WHERE post_id = :post_id");
        $statement->bindParam(':post_id', $id);
        $statement->execute();
        $result=$statement->rowcount();
        return $result;
  }

    public static function userLiked($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM likes WHERE post_id = :post_id AND user_id = :user ");
        $statement->bindValue(':user', $_SESSION['user']);
        $statement->bindValue(':post_id', $id); 
        $statement->execute();
        $result=$statement->rowcount();
        return $result; 
    }

}

?>