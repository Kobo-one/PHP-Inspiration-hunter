<?php
  
include_once("./lib/classes/User.class.php");

   
    if(!empty($_POST)){
    //sessie starten zodat je email kan gebruiken in query   
    session_start();
    
    $followerId=$_POST['followerId'];
    

    $user = new User();
    $user->setId($followerId);
    if(isset($_POST['active'])){
    $active= $_POST['active'];
        if ($user->existFollow()==0){
            $user->newFollow();
            
        }
        else{   
            $user->setFollowStatus($active);
            $user->editFollow();
        ;}
    } 
    
    
        //insert nieuwe rij in 'followers'
    
    //1staat voor normaal volgen, andere waardes zouden kunnen staan voor geblokkeerd of ontvolgt
    
    
    
    
 
    $response= [
        "status" => "succes",
        
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    }
    
?>