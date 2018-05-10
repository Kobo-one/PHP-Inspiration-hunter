<?php
    include_once("lib/classes/User.class.php");
	include_once("lib/helpers/Security.class.php");
    include_once("lib/classes/Exceptions.class.php");
	session_start();
	if(isset($_SESSION["user"])){
		header("Location: index.php");
	}

    if(isset($_POST['submit'])){
    if( !empty($_POST)){
        
        //testing if password is secure
        $security = new Security();
        $security->password = $_POST['password'];
        $security->passwordConfirmation = $_POST['password_confirmation'];
        $security->userName = $_POST['username'];
        $security->email = $_POST['email'];

        //register new user
        if($security->checkUserName()){
            $error = "Choose another username, this one is already taken.";
        } elseif($security->checkEmail()){
            $error = "The emailadress is already in use. Login or choose another emailadress.";
        } else {
            if( $security->passwordsAreSecure() ){
                $username = $_POST['email'];
                $user = new User(); 
                $user->setFirstName( $_POST['firstname']);
                $user->setLastName( $_POST['lastname']);
                $user->setUserName( $_POST['username']);
                $user->setEmail( $_POST['email'] );
                $user->setPassword( $_POST['password'] );
        	    if($user->register()){
                    $id= $user->getIdbyEmail();
                    //send to index after register
                    session_start();
                    $_SESSION['user']=$id['id'];
            		header('Location: index.php');
        	    }  
            } else {
            $error = "Your password must be at least 9 characters long.";
            } 
        }
        
    } 
    }
    
    //if inputfields are empty, send error message
    
    

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

					<input type="text" id="firstname" name="firstname" placeholder="Firstname" required>
				</div>
	            <div class="formfield">
					<input type="text" id="lastname" name="lastname" placeholder="Lastname" required>
				</div>
				<div class="formfield">
					<input type="text" id="Username" name="username" placeholder="Username" required>
				</div>
				<div class="formfield">
					<input type="text" id="email" name="email" placeholder="E-mail" required>
				</div>
				<div class="formfield">
					<input type="password" id="password" name="password" placeholder="Password" required>
				</div>

                		<div class="formfield">
					<input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
				</div>

				<div class="formfield">
					<input type="submit" value="Sign up" name="submit" class="button">	
				</div>
        
    </form>
    
    
    
    
    
    
</body>
</html>
