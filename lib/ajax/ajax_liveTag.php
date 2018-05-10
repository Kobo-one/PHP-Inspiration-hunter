<?php
  
include_once("../classes/User.class.php");

   
    if(!empty($_POST)){
    //sessie starten zodat je email kan gebruiken in query   
    session_start();
    
    $names=$_POST['names'];
    $count=$_POST['count'];
    $i=intval($count)-1;  
    $newName=  ltrim($names[$i], '@');
        
    /*$names=implode(" ",$names);
    $newName=ltrim($names, '@');*/


    $user= new User();
    $user->setSearch($newName);
    $all= $user->findUser();

    
   
    if(count($all)==0){
        $status="error";
    }
    else{
        $status="success";
    }
 
    $response= [
        "status" => $status,
        "users" => $all,
        "count" =>$i
        
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    }
    
?>