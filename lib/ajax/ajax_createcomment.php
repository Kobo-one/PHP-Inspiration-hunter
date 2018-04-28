<?php	
		include_once("../classes/Comment.class.php");
        include_once("../classes/User.class.php");
        include_once("../classes/Post.class.php");

		$comment = new Comment();
        
        try
		{
            //hierbij zetten we niet de name tussen de [], maar de naam 'comment' die we aan de data hebben gegeven in app.js
            $comment->setText( $_POST['comment'] );
            //postId uithalen
            $comment->setPostId($_GET['post']);
            $comment->saveComment();            
 
		}
		catch(Exception $e)
		{
			$feedback['text'] = $e->getMessage();
			$feedback['status'] = "error";
            $feedback['comment'] = htmlspecialchars( $_POST['comment'] );
		}

		header('Content-Type: application/json');
		echo json_encode($feedback);

?>