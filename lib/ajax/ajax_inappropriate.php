<?php	
		include_once("../classes/Post.class.php");
        if(!empty($_POST)){
            session_start();
            $post_id = $_POST['id'];

		    $post = new Post();
            $post->setIdG($post_id);

            if($post->userFlagged()==0){
                $post->newInappropriate();
                $response= [
                    "status" => "success",
                    "type" => "flag"
                ];
            }
            else{
                $post->delInappropriate();
                $response= [
                    "status" => "success",
                    "type" => "unflag"
                ];
            }
            

		header('Content-Type: application/json');
		echo json_encode($response);
        }
?>
    