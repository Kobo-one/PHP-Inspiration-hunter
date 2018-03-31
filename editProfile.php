<?php
include_once("lib/includes/checklogin.inc.php");

?><!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
 
 
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<title>Phomo | Profile settings</title>
</head>
<body>   
   <?php include_once("nav.inc.php"); ?>
   <div class="profile_settings">
   <h1>Change your settings</h1>
   <img src="https://images.unsplash.com/profile-fb-1501021622-8b449a1a8dd6.jpg?dpr=2&auto=format&fit=crop&w=128&h=128&q=60&cs=tinysrgb&crop=faces&bg=fff" alt="avatar" class="edit_avatar">
   
   <form action="" method="post" enctype="multipart/form-data">
       <div class="formfield" id="first_input">
            <label for="image_upload" class="button_upload" id="choose_image">New profile pic</label>
            <input type="file" name="image" id="image_upload" accept=".jpg, .jpeg, .png">
        </div>	    
        <div class="formfield">
            <label for="username" class="profile_label">Current Username</label>
			<input type="text" id="username" name="username" placeholder="Change your username">
        </div>
	    <div class="formfield">
	        <label for="email" class="profile_label">Current E-mail</label>
			<input type="text" id="email" name="email" placeholder="Change your e-mail">
		</div>
        <div class="formfield">
			<label for="password" class="profile_label">Password</label>
			<input type="password" id="password" name="password" placeholder="Change your password">
        </div>
        <div class="formfield">
            <label for="password_confirmation" class="profile_label">Password confirmation</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password">
        </div>

		<div class="formfield">
			<input type="submit" value="Save settings" class="button">	
		</div>
        
    </form>
</div>
</body>
</html>