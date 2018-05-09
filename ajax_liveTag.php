<?php
  
include_once("./lib/classes/User.class.php");

   
    if(!empty($_POST)){
    //sessie starten zodat je email kan gebruiken in query   
    session_start();
    
    $names=$_POST['names'];
   
        
    $names=implode(" ",$names);
    $newName=ltrim($names, '@');


    $user= new User();
    $user->setSearch($newName);
    $all= $user->findUser();

    
    
 
    $response= [
        "status" => "success",
        "users" => $all
        
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    }
    
?>