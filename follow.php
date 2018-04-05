<?php
  
  include_once("lib/classes/User.class.php");
   
    if(!empty($_POST)){
    //sessie starten zodat je email kan gebruiken in query   
    session_start();
    
    $followerId=$_POST['followerId'];
   
    $user = new User();
    $user->setId($followerId);
    //insert nieuwe rij in 'followers'
    $user->newFollow();
    
 
    $response= [
        "status" => "succes",
        
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    }
    
?>