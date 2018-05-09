<?php
include_once("Db.class.php");
class Comment
{
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

    /* Show all comments */
	public function getAllComments(){
        $conn = Db::getInstance();
        $statement= $conn->prepare("SELECT users.username, comments.comment FROM users, comments WHERE comments.user_id = users.id AND comments.post_id= :postId");
        $statement->bindValue(':postId', $this->getPostId());    
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
		
	
	/* public function getUsername($email){
		SELECT username FROM users WHERE email= $email
	}*/

	
	public static function convertTagtoLink($string)   {  
		$expression = "/(?<=^|\s)@(\w+)/";  
		$array=self::findTags($string);
		
		$string = preg_replace_callback(
			$expression,
			function ($matches) {
				if(self::getIdByUsername($matches[1])){
					$matches[0]='<strong> <a href="profile.php?user='.self::getIdByUsername($matches[1]).'">'.$matches[0].'</a></strong>';
				}	
					return($matches[0]); 
				
			},
			$string
		);
		 return $string;  
	} 

	public static function findTags($string){
		$expression = "/(?<=^|\s)@(\w+)/";  
		preg_match_all($expression,$string,$out, PREG_PATTERN_ORDER);
		$array=$out[1];
		return $array;
		//var_dump(implode(",", $array));
		//$names=implode(",", $array);
	
	}
	
	public static function getIdByUsername($username){
		$conn = Db::getInstance();
        $statement= $conn->prepare("SELECT users.id FROM users WHERE username IN (:username)");
        $statement->bindValue(':username',$username);    
        $statement->execute();
        return $statement->fetchColumn();
	}
	   


	public function setTags($string) {
  
      /* Match hashtags */
      preg_match_all('/@(\w+)/', $string, $matches);
      
      /* Add all matches to array */
      foreach ($matches[1] as $match) {
		$keywords[] = $match;
		var_dump($match);
        }
      $this->tags = (array)$keywords;
      return $this;
	}
	

}

?>