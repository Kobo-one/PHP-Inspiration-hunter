<?php	
		include_once("../classes/Like.class.php");
        if(!empty($_POST)){
            session_start();
            $post_id = $_POST['id'];

		    $like = new Like();
            $like->setPostId( $post_id );

            if(Like::userLiked($post_id)==0){
                $like->newLike();
                $response= [
                    "status" => "success",
                    "type" => "liked"
                ];
            }
            else{
                $like->delLike();
                $response= [
                    "status" => "success",
                    "type" => "disliked"
                ];
            }
            

		header('Content-Type: application/json');
		echo json_encode($response);
        }
?>
    