<?php
include_once("lib/classes/User.class.php");
include_once("lib/classes/Image.class.php");
include_once("lib/includes/checklogin.inc.php");
include_once("lib/helpers/Security.class.php");
include_once("lib/classes/Post.class.php");

$user = new User();

if(isset($_GET['user'])){
    $id=$_GET['user'];
}else{
    $id=$user->loggedinUser();
};

$user->setId($id);
$searchedUser = $user->getDetails();
$followed= $user->checkFollower();


if(!empty($_POST)){

    if( $_POST['general'] ) {
        $user->setFirstName($_POST['firstname']);
        $user->setLastName($_POST['lastname']);
        $user->setUserName($_POST['username']);
        $user->setDescription($_POST['description']);


        //enkel wanneer de standaard afbeelding aangepast is voeren we de image class uit, anders vullen we gewoon de voirge image in
        if($_FILES['image']['size'] !== 0 && $_FILES['image']['error'] == 0){
            //make new image & set variables
            $image = new Image();
            $image->setFileName($_FILES['image']['name']);
            $image->setFileSize($_FILES['image']['size']);
            $image->setFileTmp($_FILES['image']['tmp_name']);
            $image->setFileType($_FILES['image']['type']);
            $image->setFileDir("images/".$_FILES['image']['name']);
            $image->setFileExt(strtolower((explode('.',$_FILES['image']['name']))[count(explode('.',$_FILES['image']['name']))-1]));

            //get variables to upload and save image on database
            $fileTmp = $image->getFileTmp();
            $fileDir = $image->getFileDir();
            $fileName = $image->getFileName(); 
            $fileSize = $image->getFileSize();
            
            //upload image & save on database
            if( move_uploaded_file($fileTmp, $fileDir) ){
                
                //compress image if bigger than 2MB
                $imageDestination = "images/"."cp-".$fileName;
                if($fileSize > 2097152){
                    $compImage = $image->compressImage($fileDir, $imageDestination);
                } else {
                    $compImage = $fileDir;
                }
                
                $user->setPicture( $compImage );
            }
        }
        else{
            $user->setPicture($searchedUser->picture );
        }

        $user->editUser();
        header("Refresh:0");
    }

    
    else if( $_POST['security'] ) {

        if(!empty($_POST["current_password"])){
            $user->setEmail($searchedUser->email);
            $user->setPassword($_POST["current_password"]);
            
            if($user->login()){
                    
                $user->setEmail($_POST['email']);
                
                
                if(!empty($_POST["password"])){
                    
                    $security = new Security();
                    $security->password = $_POST['password'];
                    $security->passwordConfirmation = $_POST['password_confirmation'];
                    
                    
                    if( $security->passwordsAreSecure() ){
                        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
                        $user->setPassword($hash);
                    }
                
                }
                else{
                    $user->setPassword($searchedUser->password);
                }
            }

            $user->editSecurity();
            header("Refresh:0");
        }


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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="lib/js/previewUpload.js"></script>
	<title>Phomo | Profile settings</title>
</head>
<body>   
   <?php include_once("nav.inc.php"); ?>
   <div class="profile_settings">
   <h1>Profile settings</h1>
   <img src="<?php echo htmlspecialchars($searchedUser->picture);?>" alt="avatar" class="edit_avatar" id="preview">
   
   <form action="" method="post" enctype="multipart/form-data">
       <div class="formfield" id="first_input">
            <label for="image_upload" class="button_upload" id="choose_image">Edit profile pic</label>
            <input type="file" name="image" id="image_upload" accept=".jpg, .jpeg, .png"  onchange="filePreview(this);">
        </div>	    
    
	    <div class="formfield">
	        <label for="firstname" class="profile_label">Firstname</label>
			<input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($searchedUser->firstname) ?>" onchange="showButtons(id);">
		</div>

    
	    <div class="formfield">
	        <label for="lastname" class="profile_label">Lastname</label>
			<input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($searchedUser->lastname) ?>" onchange="showButtons(id);">
		</div>

        <div class="formfield">
            <label for="username" class="profile_label">Username</label>
			<input type="text" id="username" name="username" value="<?php echo htmlspecialchars($searchedUser->username) ?>">
        </div>

        
        <div class="formfield">
            <label for="description" class="profile_label">Description</label>
            <textarea id="description" name="description"><?php echo Post::convertHashtoLink(htmlspecialchars($searchedUser->description));?></textarea>
        </div>
    
		<div class="formfield" id="submit">
			<input type="submit" value="Change" name="general" class="button">	
		</div>
    </form>
    


    <h1>Security settings</h1>
    <form action="" method="post" enctype="multipart/form-data">
	    <div class="formfield">
	        <label for="email" class="profile_label">E-mail</label>
			<input type="text" id="email" name="email" value="<?php echo htmlspecialchars($searchedUser->email);?>">
		</div>

        <div class="formfield">
			<label for="password" class="profile_label">New Password</label>
			<input type="password" id="password" name="password" placeholder="Change your password" autocomplete="new-password" onfocus="confirm(this)">
        </div>

        <div class="formfield invisible newpass">
            <label for="password_confirmation" class="profile_label">New Password confirmation</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" autocomplete="new-password">
        </div>
        
        <div class="formfield">
			<label for="current_password" class="profile_label">Current Password*</label>
			<input type="password" id="current_password" name="current_password" placeholder="Current password to confirm changes" autocomplete="new-password">
        </div>

		<div class="formfield" id="submit">
			<input type="submit" value="Change" name="security" class="button">	
		</div>
        
    </form>
</div>
</body>
<script>
    function confirm(x){
        $(".newpass").slideDown();
        $("#password").focusout(function(){
            if($("#password").val().length === 0){
                $(".newpass").slideUp();

            };
        });
    };


</script>
</html>