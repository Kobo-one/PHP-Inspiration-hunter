<?php
include_once("lib/classes/User.class.php");
include_once("lib/classes/Post.class.php");
include_once("lib/classes/Like.class.php");
include_once("lib/includes/checklogin.inc.php");

$post = new Post();
$user = new User();

if(isset($_GET['user'])){
    $id=$_GET['user'];
}
else{
    $id=$user->loggedInUser();
}

$post->setIdG($id);
$collection= $post->getDetailsProfile();

$user->setId($id);

$searchedUser = $user->getDetails();


$count=$user->checkFollower();
if(isset($_POST['follow'])|isset($_POST['unfollow'])){
    if ($user->existFollow()==0){
        $user->newFollow();
        
    }
    else{   
        if(isset($_POST['follow'])){
            $active=1;
        };
        if(isset($_POST['unfollow'])){
            $active=0;
        };
        $user->setFollowStatus($active);
        $user->editFollow();
    ;}


};


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

  <div class="profile_user" id="user_<?php echo $_GET['user'];?>">
              <div class="blue_container"></div>
              <img src="<?php echo $searchedUser->picture?>" alt="avatar" class="avatar">
              <h2><?php echo $searchedUser->username ?></h2>
               
              <div class="description"><?php echo $searchedUser->description ?></div>
              <div class="flex_container">
              <div class="extra"><?php echo $post->getProfilePostAmount()?> posts</div>
              <div class="extra"><?php echo $user->getFollowersAmount()?> followers</div>
              </div>
              
              <?php
              //kijken of we op onze eigen pagina zijn of niet
              if(isset($_GET['user']) && $user->loggedinUser()!==$_GET['user'] && $count==0 ){
                // follow-btn wanneer niet op eigen profielpagina en je nog niet bevriend bent
              echo '<div class="form">
              <form action="" method="post">
              <input type="submit" value="Follow" class="button button--follow" name="follow">
              </form>';
            }
            //kijken of ze al bevriend zijn
            else if($count>=1){
                //unfollow-btn als ze al bevriend zijn
              echo '<div class="form">
              <form action="" method="post">
              <input type="submit" value="Unfollow" class="button button--unfollow" name="unfollow">
              </form>';
            }
            else{
                // edit-btn wanneer op eigen profielpagina
              echo '<div class="button "><a href="editProfile.php" class="edit">Edit</a></div>
              </div>
             
              <div class="button" id="button_notif" ';

              if(!count(Notification::getUnseen())==0)
              {echo('style="background:#41e1fc"');};
              echo'> <a href="notification.php">Notifications</a></div>
              
              </div>';}
              ?>    
    </div>
<div class="collection">

    <?php foreach($collection as $key =>$c): ?> 
        <div class="item">
            
            <a href="detail.php?post=<?php echo$c['id'];?>">
                <figure class="<?php echo ($c['filter']);?> figure_index">
                <img src="<?php echo htmlspecialchars($c['image'])?>" alt="image" class="picture_index">
                </figure>    
            </a>
            
            <div id="detail_photo_text" class="feed_flex">
            
            <div class="date"><?php echo(Post::timeAgo($c['created']));?></div>
            <div class="likes"><span><?php echo Like::countLikes($c['id']) ;?></span> likes</div>
            
            <?php if (Like::userLiked($c['id'])==0):?>
                <a href="#"><img src="images/tolike_btn.png" alt="like button" class="like_btn" id="post_<?php echo $c['id'];?>"></a>
            
            <?php else:?>    
                <a href="#"><img src="images/liked_btn.png" alt="like button" class="like_btn" id="post_<?php echo $c['id'];?>"></a>
            
            <?php endif; ?>  

            </div>
        </div>
    <?php endforeach; ?>
   
</div> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="lib/js/follow.js"></script>

<script src="lib/js/like.js"></script>
</body>
</html>