<?php	
		include_once("../classes/Comment.class.php");
      
		if(!empty($_POST)){
			session_start();
			$comment = new Comment();
        
        
            //$_POST komt uit ajax call: data{}, niet van detail.php
            $comment->setText( $_POST['comment'] );
			
            $comment->setPostId($_POST['postId']);
			$comment->saveComment(); 
			$text=Comment::convertTagtoLink(htmlspecialchars($_POST['comment']));
			/*$comment->getUsername($_SESSION['username']);*/
            
			$feedback= [
				"status" => "success",
				"comment"=> ( $text),
				"user"=>$_SESSION['user']
				
			];
			header('Content-Type: application/json');
			echo json_encode($feedback);
			
		}

		

?>