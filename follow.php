<?php
  
  include_once("lib/classes/User.class.php");
   
    if(!empty($_POST)){
    //sessie starten zodat je email kan gebruiken in query   
    session_start();
    
    $followerId=$_POST['followerId'];
   
    $user = new User();
    $user->setId($followerId);
    $user->setFollowStatus(1); //1staat voor normaal volgen, andere waardes zouden kunnen staan voor geblokkeerd of ontvolgt
    //insert nieuwe rij in 'followers'
    $user->newFollow();
    
 
    $response= [
        "status" => "succes",
        
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    }
    
?>