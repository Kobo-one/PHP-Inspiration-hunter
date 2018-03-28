<?php
    // zijn al die includes nodig of enkel function??
    include_once("lib/classes/User.class.php");
    include_once("lib/helpers/Security.class.php");

    //user and password from post oproepen
    //eerst kijken of het formulier al is verzonden anders geeft het een foutmelding
    try{
      if(!empty($_POST)){

        $username = $_POST['email'];
        $password= $_POST['password'];
 
  // kan de user inloggen?   
  $user = new User(); 
        $user->setEmail( $_POST['email'] );
        $user->setPassword( $_POST['password'] );
        	if($user->login()){
                session_start();
                $_SESSION['username']=$username;
            		header('Location: index.php');
          }  
          
    }
  }
    catch(Exception $e) {
            $error= "Error: signup incomplete";
        } 


}

?><!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <title>Phomo | Login</title>
</head>
<body>
    <img src="images/logo_phomo.png" alt="Phomo logo" class="logo">
    <form action="" method="post">
    
                <h1>Already have an account?</h1>
        <!-- zorgen dat de error enkel print als er een is en niet sowieso bij openen pagina -->       
        <?php if (isset($error)):?>
                <div class="form__error">
					<p>
						Woopsie, we couldn't log you in. Maybe you typed something wrong? 
					</p>
		        </div>
        <?php endif; ?>
                
				<div class="formfield">
					<input type="text" id="email" name="email" placeholder="E-mail">
				</div>
				<div class="formfield">
					<input type="password" id="password" name="password" placeholder="Password">
				</div>

				<div class="formfield">
					<input type="submit" value="Login" class="button">	
		        </div>
    </form>
    
    
    
    
    
    
</body>
</html>