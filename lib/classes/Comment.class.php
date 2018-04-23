<?php
require_once("Db.class.php");
class Comment
{
	// PRIVATE MEMBER VARIABLES
	private $text;
	private $userId;
    private $postId;

    /* Setters */
	public function setText($text)
	{
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
		$this->userId = $postId;
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

    /* Save comment */
	public function Save()
	{
		$db = Db::getInstance();
		$table = "comments";
		$cols = array("comment", "user_id", "post_id");
		$values = array($this->getText(), $this->getUserId(), $this->getPostId());
		$db->insert($table, $cols, $values);
	}

	public function GetAll()
	{
		$db = Db::getInstance();
		$cols = array("*");
		$result = $db->select($cols, "comments", null, "id", "DESC");
		return($result);
	}
}
?>