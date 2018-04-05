<?php
  
  include_once("lib/classes/User.class.php");
   
    if(!empty($_POST)){
        session_start();
    $followerId=$_POST['followerId'];
   
    $user = new User();
    $user->setId($followerId);
    $user->newFollow();
    
 
    $response= [
        "status" => "succes",
        
    ];
    header('Content-Type: application/json');
   echo json_encode($response);
    }
    
?>