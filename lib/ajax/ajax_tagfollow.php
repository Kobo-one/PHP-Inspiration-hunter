<?php
  
include_once("../classes/Post.class.php");

   
    if(!empty($_POST)){
    //sessie starten   
    session_start();
    
    $tag=$_POST['tagName'];
    
    $post = new Post();
    $post->setSearch($tag);

    if(isset($_POST['active'])){
    $active= $_POST['active'];
        if ($post->existFollow()==0){
            $post->newFollow();
            
        }
        else{ 
            $post->setFollowStatus($active);
            $post->editFollow();
            
        }
    } 
    
    
        //insert nieuwe rij in 'followers'
    
    //1staat voor normaal volgen, andere waardes zouden kunnen staan voor geblokkeerd of ontvolgt
    
    
    
    
 
    $response= [
        "status" => "succes"
        
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    }
    
?>