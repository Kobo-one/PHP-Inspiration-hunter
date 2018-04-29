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
    
    //vervang elke datum door leesbare datum
    foreach($collection as &$c){
        $c['created']= Post::timeAgo($c['created']); 
    }

    //Als er 21 resultaten zijn, halen we de laatste weg (want we tonen per 20 resultaten)
    if($count==21){
        $collection= array_slice($collection, 0, 20);  
    }        
   
    $response= [
        "status" => "succes",
        "collection" => $collection,
        "count"=> $count
    ];
    header('Content-Type: application/json');
    echo json_encode($response);  
}
    
?>