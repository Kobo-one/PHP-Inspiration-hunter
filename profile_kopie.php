<?php
include_once("lib/classes/Post.class.php");
include_once("lib/includes/checklogin.inc.php");

?><!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
 
 
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<title>Phomo | Profile</title>
</head>
<body>   
   <?php include_once("nav.inc.php"); ?>

  <div class="profile_user">
        
              <img src="https://images.unsplash.com/profile-fb-1501021622-8b449a1a8dd6.jpg?dpr=2&auto=format&fit=crop&w=128&h=128&q=60&cs=tinysrgb&crop=faces&bg=fff" alt="avatar" class="avatar">
              <h2>Username</h2>
              <div class="flex_container">
              <div class="extra"># posts</div>
              <div class="extra"># friends</div>
              </div>
              <!-- Ofwel follow-btn wanneer niet op eigen profielpagina -->
              <div class="form">
              <form action="" method="post">
              <input type="submit" value="Follow" class=" button invisible">
              </form>
              <!-- Ofwel edit-btn wanneer op eigen profielpagina -->
              <div class="button "><a href="editProfile.php" class="edit">Edit</a></div>
              </div>
              <div class="blue_container"></div>      
    </div>
<div class="collection">
    <div class="item">
    <a><img src="https://images.unsplash.com/photo-1515342870411-fdedf6a7c373?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=3f4e0f48166791d198e5cc2d9a8419b6&auto=format&fit=crop&w=962&q=80" alt="image" class="picture_index"></a>
    <div class="date">17/03/2018</div>
    <div class="likes"># likes</div>
    </div>
    <div class="item">
    <a><img src="https://images.unsplash.com/photo-1494797262163-102fae527c62?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=0f06672063bb4021d19469dd62e5a1d9&auto=format&fit=crop&w=1000&q=80" alt="image" class="picture_index"></a>
    <div class="date">17/03/2018</div>
    <div class="likes"># likes</div>
    </div>
    <div class="item">
    <a><img src="https://images.unsplash.com/photo-1514908162061-89747fab8b1e?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=fb9e2cc4a906ae0c1685939dcb4c82a3&auto=format&fit=crop&w=2100&q=80" alt="image" class="picture_index"></a>
    <div class="date">17/03/2018</div>
    <div class="likes"># likes</div>
    </div>
    <div class="item">
    <a><img src="https://images.unsplash.com/photo-1512794751227-fefb9f898224?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=ed90dfd9d5890d4edd8a9288d940572e&auto=format&fit=crop&w=2100&q=80" alt="image" class="picture_index"></a>
    <div class="date">17/03/2018</div>
    <div class="likes"># likes</div>
    </div>
</div> 

</body>
</html>