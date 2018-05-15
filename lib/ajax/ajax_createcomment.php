<?php	
		include_once("../classes/Comment.class.php");
		include_once("../classes/Notification.class.php");
		if(!empty($_POST)){
			session_start();
			$comment = new Comment();
        
        
            //$_POST komt uit ajax call: data{}, niet van detail.php
            $comment->setText( $_POST['comment'] );
			$comment->setUserId($_SESSION['user']);
            $commentUsername = htmlspecialchars($comment->commentUsername());
            $comment->setPostId($_POST['postId']);
			$comment->saveComment(); 
			$text=Comment::convertTagtoLink(htmlspecialchars($_POST['comment']));
			$array=$comment->findTags();
			if ($array>=1){
				$notif= new Notification();
            
            foreach($array as $a){
					$notif->setTagged($a);
					$notif->setPostId($_POST['postId']);
					$notif->setUserId($_SESSION['user']);
					$notif->saveNotif();	
				}
			}
            
			$feedback= [
				"status" => "success",
				"comment"=> ( $text),
				"user"=>$commentUsername
				
			];
			header('Content-Type: application/json');
			echo json_encode($feedback);
			
		}

		

?>