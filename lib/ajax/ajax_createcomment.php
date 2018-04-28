<?php	
		include_once("../classes/Comment.class.php");
        include_once("../classes/User.class.php");
        include_once("../classes/Post.class.php");

		$comment = new Comment();
        
        try
		{
            //userId uit je session halen
            $comment->setUserId($_SESSION['username']);
            
            //hierbij zetten we niet de name tussen de [], maar de naam 'comment' die we aan de data hebben gegeven in app.js
            $comment->setText( $_POST['comment'] );
            //postId uithalen
            $comment->setPostId($_GET['post']);
            $comment->saveComment();
            $feedback['text'] = "Your comment has been posted!";
			$feedback['status'] = "success";
            
 
		}
		catch(Exception $e)
		{
			$feedback['text'] = $e->getMessage();
			$feedback['status'] = "error";
		}

		header('Content-Type: application/json');
		echo json_encode($feedback);

        
?>