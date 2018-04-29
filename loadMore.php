<?php
  include_once("./lib/classes/Post.class.php");
  
   
    if(!empty($_POST)){
        session_start();
    $i=$_POST['i'];
   
    $post = new Post();
    $post->setClick($i);
    $collection=[];
    $collection=$post->loadMore()->fetchAll(PDO::FETCH_ASSOC);
    $count=$post->loadMore()->rowCount();
   
    if($count==20){
        $i++;
        $post->setClick($i);
        $rest=$post->loadMore()->rowCount();
        if ($rest==0){
            $count=0;
        }

    }
    //json_encode($collection);
    //var_dump($collection);
    $response= [
        "status" => "succes",
        "collection" => $collection,
        "count"=> $count
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    }
    
?>