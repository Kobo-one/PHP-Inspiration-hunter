<?php

    // moet ik hier nog een connectie maken dan? of is met include oke??
   include_once("Db.class.php");

//this function checks if a user can login and returns TRUE or FALSE
function canILogin($Username, $Password){


//BCRYPT METHODE
//checken of je kan inloggen of niet (sessie aanmaken moet in andere functie)
$query = "select * from users where email = '".$conn->real_escape_string($Username)."'";
	$result = $conn->query($query);
		if($result->num_rows == 1){
			$user = $result->fetch_assoc();
			if(password_verify($Password, $user['password'])){
				return true;
			}
	}
	else{
		return false;
	}
}


/* SEARCH*/
if (isset($_GET['search'])){
	$search=$_GET['search'];
	$newCollection=[];
	foreach ($collection as $key => $c){
	  if (strpos(strtolower($c['title']), strtolower ($search)) !== false){
  $newCollection[$key] = $c;
	  }
	}
	$collection = $newCollection;
  };
?>
