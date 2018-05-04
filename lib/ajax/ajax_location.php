<?php 
    session_start();
        $_SESSION['lat']=$_POST['lat'];
        $_SESSION['lng']=$_POST['lng'];
			
		$feedback= [
			"status" => "success"
		];
		header('Content-Type: application/json');
		echo json_encode($feedback);
			
                
?>
