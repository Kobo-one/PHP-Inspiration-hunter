<?php
  
  include_once("lib/classes/Post.class.php");
   //checken of ajax call leeg is of niet(niet het form)
    /*
        //$.ajax meegegeven (niet uit de form)
        $comment=$_POST['comment'];
        $postId=$_POST['postId'];

        $db= Db::getInstance();
        $c= new Comment($db);
        $c->setComment($comment);
        $c->setPostId($postId);
        $c->Save();

        $response= [
            "status" => "succes",
            "comment" => $comment
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }  */
    if(!empty($_POST)){
    $i=$_POST['i'];
   
    $post = new Post();
    $post->setClick($i);
    //$post->loadMore();
    //$collection=$post->loadMore();
        //var_dump($collection);
    $response= [
        "status" => "succes"
        //"collection" => collection
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    }
    
?>