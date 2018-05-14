<?php
include_once("lib/classes/Post.class.php");
include_once("lib/classes/User.class.php");
include_once("lib/classes/Like.class.php");
include_once("lib/includes/checklogin.inc.php");

$post = new Post();

/*Determine possible locations in radius of users' current location based on lng- & lat-coordinates*/
$collection= $post->getLocationsInRadius($_SESSION['lng'], $_SESSION['lat']);

/*Get all the lng- & lat-coordinates of the possible locations*/
foreach($collection as $c){
    $lng[] = floatval($c[10]);
    $lat[] = floatval($c[8]);
}

/*Get all posts in database to compare locations*/
$allPosts = $post->getLocation();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="images/favicon.ico"/>
    <title>Phomo | Posts filtered by location</title>
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
      
    <div class="collection">
  
    <?php foreach($allPosts as $p): ?>  
     
    <!-- Search through all the posts and compare the lng- & lat-coordinates -->
     <?php if((($p['lng'] >= min($lng)) && ($p['lng'] <= max($lng))) && ( ($p['lat']) >= min($lat) && ($p['lat'] <= max($lat))) ):?>   
     
     <!-- If the lng- & lat-coordinates of a post are found within the radius of current position, show this post-->
        <div class="item clearfix">
            <div class="user">
                <a href="profile.php?user=<?php echo $p['post_user_id']; ?>"><img src="<?php echo htmlspecialchars($p['picture']); ?>" alt="avatar" class="avatar"></a>
                <a href="profile.php?user=<?php echo $p['post_user_id']; ?>" class="username"><?php echo htmlspecialchars($p['username']); ?></a>
            </div>
            
            <a href="detail.php?post=<?php echo $p['id'] ?>"><img src="<?php echo htmlspecialchars($p['image']); ?> " alt="image" class="picture_index"></a>
            
            <div class="feed_flex">
                <div class="date"><?php echo(Post::timeAgo($p['created']));?></div>
                <div class="likes"><span><?php echo Like::countLikes($p['id']) ;?></span> likes</div>
         
                <?php if (Like::userLiked($p['id'])==0):?>
                <a href="#"><img src="images/tolike_btn.png" alt="like button" class="like_btn" id="post_<?php echo $p['id'];?>"></a>
         
                <?php else:?>    
                <a href="#"><img src="images/liked_btn.png" alt="like button" class="like_btn" id="post_<?php echo $p['id'];?>"></a>
                <?php endif; ?>  
            </div>
        </div>
        <?php endif; ?>
        <!-- If there are no posts within the users' location -->
        <?php if((!($p['lng'] >= min($lng)) && !($p['lng'] <= max($lng))) && (!($p['lat']) >= min($lat) && !($p['lat'] <= max($lat)))): ?>
        <?php $error="There were no posts found nearby your location."; ?>
      <?php endif; ?> 
    <?php endforeach; ?>
   
    </div>
    
    <!-- When there are no posts found nearby the users location -->
    <?php if (isset($error)):?>
                <div class="error error--index">
					<p>
						<?php echo $error ?>
					</p>
		        </div>
    <?php endif; ?>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="lib/js/like.js"></script>
<script src="lib/js/location.js"></script>

</body>
</html>