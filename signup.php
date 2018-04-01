<?php
    include_once("lib/classes/User.class.php");
	include_once("lib/helpers/Security.class.php");
	session_start();
	if(isset($_SESSION["username"])){
		header("Location: index.php");
	}
    
    try{
    if( !empty($_POST)){
        
        //testing if password is secure
        $security = new Security();
        $security->password = $_POST['password'];
        $security->passwordConfirmation = $_POST['password_confirmation'];
        
        //register new user
        if( $security->passwordsAreSecure() ){
        $user = new User(); 
        $user->setFirstName( $_POST['firstname']);
        $user->setLastName( $_POST['lastname']);
        $user->setUserName( $_POST['username']);
        $user->setEmail( $_POST['email'] );
        $user->setPassword( $_POST['password'] );
        	if($user->register()){
                    //send to index after register
                    session_start();
                    $_SESSION['username']=$username;
            		header('Location: index.php');
        	}  
        }
     }
    }
    //if inputfields are empty, send error message
    catch(Exception $e) {
            $error= $e->getMessage();
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
    
    <title>Phomo | Signup</title>
</head>
<body>
    <img src="images/logo_phomo.png" alt="Phomo logo" class="logo">
    <form action="" method="post">
				<h1>Sign up for an account!</h1>
  
                        		
	    			<?php if(isset($error)): ?>
                		<div class="error">
                    		<p><?php echo $error; ?></p>
                		</div>
                		<?php endif; ?>
	    
                		<div class="formfield">

					<input type="text" id="firstname" name="firstname" placeholder="Firstname">
				</div>
	            <div class="formfield">
					<input type="text" id="lastname" name="lastname" placeholder="Lastname">
				</div>
				<div class="formfield">
					<input type="text" id="Username" name="username" placeholder="Username">
				</div>
				<div class="formfield">
					<input type="text" id="email" name="email" placeholder="E-mail">
				</div>
				<div class="formfield">
					<input type="password" id="password" name="password" placeholder="Password">
				</div>

                		<div class="formfield">
					<input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password">
				</div>

				<div class="formfield">
					<input type="submit" value="Sign up" class="button">	
				</div>
        
    </form>
    
    
    
    
    
    
</body>
</html>
