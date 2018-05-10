<?php	
		include_once("../classes/Comment.class.php");
      
		if(!empty($_POST)){
			session_start();
			$comment = new Comment();
        
        
            //$_POST komt uit ajax call: data{}, niet van detail.php
            $comment->setText( $_POST['comment'] );
			$comment->setUserId($_SESSION['user']);
            $commentUsername = $comment->commentUsername();
            $comment->setPostId($_POST['postId']);
			$comment->saveComment(); 
			$text=Comment::convertTagtoLink(htmlspecialchars($_POST['comment']));
			
            
			$feedback= [
				"status" => "success",
				"comment"=> ( $text),
				"user"=>$commentUsername
				
			];
			header('Content-Type: application/json');
			echo json_encode($feedback);
			
		}

		

?>