<?php
include_once("Db.class.php");
class Comment
{
	// PRIVATE MEMBER VARIABLES
	private $text;
	private $userId;
    private $postId;

    /* Setters */
	public function setText($text)
	{
        if(empty($text)){
            throw new Exception("Please fill in a comment.");
        }
		$this->text = $text;
		return $this;
	}

	public function setUserId($userId)
	{
		$this->userId = $userId;
		return $this;
	}
    
    public function setPostId($postId)
	{
		$this->postId = $postId;
		return $this;
	}
    
	/* Getters */ 
	public function getText()
	{
		return $this->text;
	}

	public function getUserId()
	{
		return $this->userId;
	}
    
    public function getPostId()
	{
		return $this->postId;
	}

    /* Save comment in database */
	public function saveComment(){
		$conn = Db::getInstance();
        $statement= $conn->prepare("INSERT INTO comments (comment, user_id, post_id) VALUES(:text, (SELECT users.id FROM users WHERE users.email=:email), (SELECT posts.id FROM posts WHERE posts.id=:postId))");
        $statement->bindValue(':text', $this->getText());
        $statement->bindValue(':email', $_SESSION['username']);
        $statement->bindValue(':postId', $this->getPostId()); 
        $comment_added = $statement->execute();
        return $comment_added; 
	}

	public function getAllComments(){
    $conn = Db::getInstance();
    $statement= $conn->prepare("SELECT users.username, comments.comment FROM users, comments WHERE comments.user_id = users.id AND comments.post_id= :postId");
    $statement->bindValue(':postId', $this->getPostId());    
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
        
}

?>