<?php
  
include_once("../classes/User.class.php");

   
    if(!empty($_POST)){
    session_start();
    
    $names=$_POST['names'];
    $count=$_POST['count'];
    $i=intval($count)-1;  
    /*i -1 omdat array van 0 begint te tellen*/
    $newName=  ltrim($names[$i], '@');
        

    $user= new User();
    $user->setSearch($newName);
    $all= $user->findUser();

    
    if(count($all)==0){
        //dus er zijn geen namen die aan het de input voldoen
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