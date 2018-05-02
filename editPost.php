<?php
include_once("lib/classes/Post.class.php");
include_once("lib/includes/checklogin.inc.php");
include_once("lib/classes/Comment.class.php");
include_once("lib/classes/User.class.php");

$user = new User();
if(isset($_GET['user'])){
    $id=$_GET['user'];
}else{
    $id=$user->loggedinUser();
};

$user->setId($id);
$searchedUser = $user->getDetails();

//show post with details
$post = new Post();
$post->setIdG($_GET['post']);
$collection= $post->getDetailsPost();

//edit post description
if(isset($_POST['btnEditPost'])){
    $post->setDescription($_POST['description']);
    $post->editPost();
    header("Location:profile.php");
}
//delete post
if(isset($_POST['btnDeletePost'])){
    $post->deletePost();
    header("Location:profile.php");
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

	<title>Phomo | Edit post</title>
</head>
<body>
  <?php include_once("nav.inc.php"); ?>
  
<div class="form_edit_post">
    <h1>Edit or delete your post</h1>
    <div>
        <img src="<?php echo htmlspecialchars($collection[0]['image']);?>" alt="image">
    </div>
    
    
    <form action="" method="post">
        <div class="formfield">
            
            <textarea name="description" id="description" rows="4" placeholder="<?php echo htmlspecialchars($collection[0]['description']); ?>"></textarea>
        </div> 
        <div class="formfield btn_min">
        <input type="submit" name="btnEditPost" id="btnEditPost" class="button" value="Save changes" />
        </div>
        <div class="formfield">
        <input type="submit" name="btnDeletePost" id="btnDeletePost" class="button" value="Delete post" />
        </div>
    </form>   
    
</div>
</body>
</html>