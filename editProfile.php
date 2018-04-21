<?php
include_once("lib/classes/User.class.php");
include_once("lib/includes/checklogin.inc.php");

$user = new User();


if(isset($_GET['user'])){
    $id=$_GET['user'];
}else{
    $id=$user->loggedinUser();
}

$user->setId($id);
$searchedUser = $user->getDetails();
$followed= $user->checkFollower();

?><!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="lib/js/script.js"></script>
	<title>Phomo | Profile settings</title>
</head>
<body>   
   <?php include_once("nav.inc.php"); ?>
   <div class="profile_settings">
   <h1>Profile settings</h1>
   <img src="<?php echo $searchedUser->picture?>" alt="avatar" class="edit_avatar" id="preview">
   
   <form action="" method="post" enctype="multipart/form-data">
       <div class="formfield" id="first_input">
            <label for="image_upload" class="button_upload" id="choose_image">Edit profile pic</label>
            <input type="file" name="image" id="image_upload" accept=".jpg, .jpeg, .png"  onchange="filePreview(this);">
        </div>	    
    
		<div class="formfield invisible" id="submit_image"> 
			<input type="submit" value="Change" class="button">	
		</div>

    </form>

    <form action="" method="post" enctype="multipart/form-data">
	    <div class="formfield">
	        <label for="firstname" class="profile_label">Firstname</label>
			<input type="text" id="firstname" name="firstname" placeholder="<?php echo $searchedUser->firstname ?>" onchange="showButtons(id);">
		</div>

    
    <form action="" method="post" enctype="multipart/form-data">
	    <div class="formfield">
	        <label for="lastname" class="profile_label">Lastname</label>
			<input type="text" id="lastname" name="lastname" placeholder="<?php echo $searchedUser->lastname ?>" onchange="showButtons(id);">
		</div>

    
		<div class="formfield invisible" id="submit_firstname">
			<input type="submit" value="Change" class="button">	
		</div>
    
    </form>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="formfield">
            <label for="username" class="profile_label">Username</label>
			<input type="text" id="username" name="username" placeholder="<?php echo $searchedUser->username ?>">
        </div>

    
		<div class="formfield invisible" id="submit_username">
			<input type="submit" value="Change" class="button">	
		</div>
    
    </form>
    <form action="" method="post" enctype="multipart/form-data">
	    <div class="formfield">
	        <label for="email" class="profile_label">E-mail</label>
			<input type="text" id="email" name="email" placeholder="<?php echo $_SESSION['username']?>">
		</div>

    
		<div class="formfield invisible" id="submit_email">
			<input type="submit" value="Change" class="button">	
		</div>
    
    </form>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="formfield">
			<label for="password" class="profile_label">Password</label>
			<input type="password" id="password" name="password" placeholder="Change your password">
        </div>

    
    <form action="" method="post" enctype="multipart/form-data">
        <div class="formfield">
            <label for="password_confirmation" class="profile_label">Password confirmation</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password">
        </div>
        
		<div class="formfield invisible" id="submit_password">
			<input type="submit" value="Change" class="button">	
		</div>
    
    </form>

</div>
</body>
</html>