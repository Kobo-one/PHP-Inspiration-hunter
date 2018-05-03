<?php	
		include_once("../classes/Comment.class.php");
      
		if(!empty($_POST)){
			session_start();
			$comment = new Comment();
        
        
            //hierbij zetten we niet de name tussen de [], maar de naam 'comment' die we aan de data hebben gegeven in app.js
            $comment->setText( $_POST['comment'] );
			//postId uithalen
			
            $comment->setPostId($_POST['postId']);
			$comment->saveComment(); 
			
            /*$feedback['text'] = "Your comment has been posted!";
			$feedback['status'] = "success";
            $feedback['comment'] = htmlspecialchars( $_POST['comment'] );*/
			$feedback= [
				"status" => "success",
				"comment"=> htmlspecialchars( $_POST['comment'] ),
				"user"=>$_SESSION['username']
				
			];
			header('Content-Type: application/json');
			echo json_encode($feedback);
			
		}

		

?>