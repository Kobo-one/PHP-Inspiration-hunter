<?php
include_once("lib/classes/User.class.php");
include_once("lib/classes/Post.class.php");
include_once("lib/includes/checklogin.inc.php");
include_once("lib/includes/functions.inc.php");


$post = new Post();
$user = new User();


if(isset($_GET['user'])){
    $id=$_GET['user'];
}else{
    $id=$user->loggedinUser();
}

$post->setIdG($id);
$collection= $post->getDetailsProfile();

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
	<title>Phomo | Profile</title>
</head>
<body>   
   <?php include_once("nav.inc.php"); ?>

  <div class="profile_user">
        
              <img src="<?php echo $searchedUser->picture?>" alt="avatar" class="avatar">
              <h2><?php echo $searchedUser->username ?></h2>
              <div class="flex_container">
              <div class="extra"><?php echo $post->getProfilePostAmount()?> posts</div>
              <div class="extra"><?php echo $user->getFollowersAmount()?> followers</div>
              </div>
              <?php
              
              //kijken of we op onze eigen pagina zijn of niet
              if(isset($_GET['user']) && $user->loggedinUser()!==$_GET['user'] && $followed<1 ){
                // follow-btn wanneer niet op eigen profielpagina en je nog niet bevriend bent
              echo '<div class="form">
              <form action="" method="post">
              <input type="submit" value="Follow" class="button button--follow">
              </form>';
            }
            //kijken of ze al bevriend zijn
            else if($followed>0){
                //unfollow-btn als ze al bevriend zijn
              echo '<div class="form">
              <form action="" method="post">
              <input type="submit" value="Unfollow" class="button">
              </form>';
            }
            else{
                // edit-btn wanneer op eigen profielpagina
              echo '<div class="button "><a href="editProfile.php" class="edit">Edit</a></div>
              </div>
              <div class="blue_container"></div>';}
              ?>    
    </div>
<div class="collection">

    <?php foreach($collection as $key =>$c): ?> 
        <div class="item">
            
            <a href="detail.php?post=<?php echo$c['id'];?>"><img src="<?php echo $c['image']?>" alt="image" class="picture_index"></a>
            
            <div id="detail_photo_text">
            
            <div class="date"><?php echo timeAgo($c['created'])?></div>
            <div class="likes">Likes</div>
            
            </div>
        </div>
    <?php endforeach; ?>
   
</div> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
 $(".button--follow").on("click", function(e){
        //id van de user die je wilt volgen meegeven
        var followerId= <?php echo $_GET['user'];?>;
    
        $.ajax({
            method: "POST",
            url: "follow.php",
            data: { followerId: followerId}
            })
            .done(function( res ) {
            if (res.status == "succes"){
            //Insert statement OK ->button 'refreshen': nieuwe class en value
            $(".button--follow").val("unfollow");
            $(".button--follow").removeClass("button--follow").addClass("button--unfollow");
            console.log("succesvol verstuurd");
            }  
         });           
           
            e.preventDefault();
    });
</script>

</body>
</html>