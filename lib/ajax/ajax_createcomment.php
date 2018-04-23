<?php	
		include_once("../classes/Comment.class.php");
		$comment = new Comment();
        
        try
		{
            //userId uit je session halen
			$comment->setUserId(1);
            //hierbij zetten we niet de name tussen de [], maar de naam 'tweet' die we aan de data hebben gegeven in app.js
            $comment->setText( $_POST['comment'] );
            //postId uithalen
            $comment->setPostId(1);
            $comment->Save();
 
		}
		catch(Exception $e)
		{
			$feedback['text'] = $e->getMessage();
			$feedback['status'] = "error";
		}

		header('Content-Type: application/json');
		echo json_encode($feedback);

        
?>