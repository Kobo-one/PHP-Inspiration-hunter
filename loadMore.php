<?php
  
  include_once("lib/classes/Post.class.php");
   
    if(!empty($_POST)){
        session_start();
    $i=$_POST['i'];
   
    $post = new Post();
    $post->setClick($i);
    $collection= array();
    $collection=$post->loadMore();
    
    //json_encode($collection);
    //var_dump($collection);
    $response= [
        "status" => "succes",
        "collection" => $collection
    ];
    header('Content-Type: application/json');
   echo json_encode($response);
    }
    
?>