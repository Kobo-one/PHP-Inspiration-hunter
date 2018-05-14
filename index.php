<?php
include_once("lib/classes/Post.class.php");
include_once("lib/classes/User.class.php");
include_once("lib/classes/Like.class.php");
include_once("lib/includes/checklogin.inc.php");
$user = new User();
$user->setId($_SESSION["user"]);

/* als je nog geen vrienden hebt-> toon posts met meeste likes
getFollowersAmount staat status niet op 1 dus als die op 0 staat werkt het nog niet*/

 if($user->getFollowersAmount()==0){   
   $collection= Post::getTopPosts();
    $friendless="";
   
 } 
 /* als je al vrienden hebt -> toon posts van je vrienden */

 else{
    /* als er minder dan 20 posts op de index pagina worden getoond -> aanvullen met populairste posts*/
    if(POST::allPost(21)->rowCount()<20){
        $friends= Post::getAll(21);
    
        $popular= Post::getTopPosts();
    
        $merge=array_merge($friends, $popular);
        $unique=array_unique($merge, SORT_REGULAR);
        $collection = array_slice($unique, 0, 19);
    }
    /* als er meer dan 20 posts worden getoond dan enkel posts vrienden tonen */
    else{
        $friends=Post::getAll(21);
        
        $collection=array_slice($friends,0,20);
        
        $click=1;
        if (isset($_POST['loadMore'])){
            $click++;
            echo("Dit is het aantal kilks".$click);
            $amount= ($click*20)+1;
            
            $friends=Post::getAll($amount);
        // var_dump($friends);
            array_pop($friends);
            $collection=$friends;
            //var_dump($collection);

        }
        $postedpost = count($friends);
    }
 }


//$totalpost = Post::allPost()->rowCount();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="images/favicon.ico"/>
    <title>Phomo | HOME</title>
</head>
<body>
   <?php include_once("nav.inc.php"); ?>
  
    <?php if (isset($error)):?>
                <div class="error error--index">
					<p>
						<?php echo $error ?>
					</p>
		        </div>
    <?php endif; ?>  
    <?php if (isset($friendless)):?>
                <div class="noFriends">
                    <h2> It appears you don't have any friends yet!</h2>
                    <p>Search friends on their name or your interests. Or check out what other awesomeness people made below!</p>
                </div>
    <?php endif; ?>
    
    <div class="filter_location"><a href="location.php">Show posts nearby</a></div> <div class="filter_location filter_map"><a href="world.php">Show posts on a map</a></div>
                   
   <div class="collection">
   
<!--BEGIN FOTO'S UIT DATABASE-->  
<?php foreach($collection as $key =>$c): ?>    
      <div class="item clearfix">
         <div class="user">
             <a href="profile.php?user=<?php echo $c['post_user_id'] ?>"><img src="<?php echo htmlspecialchars($c['picture']); ?>" alt="avatar" class="avatar"></a>
              <a href="profile.php?user=<?php echo $c['post_user_id'] ?>" class="username"><?php echo htmlspecialchars($c['username']); ?></a>
         </div>
         
            <a href="detail.php?post=<?php echo $c['id'] ?>">
                <figure class="<?php echo ($c['filter']);?> figure_index">
                <img src="<?php echo htmlspecialchars($c['image']); ?> " alt="image" class="picture_index">
                </figure>
            </a>
        
         <div class="feed_flex">
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
<!--EINDE-->
        </div>
        <!-- Loadmore knop enkel tonen als er 20 resultaten zijn -->
       <?php if(POST::allPost(21)->rowCount()==21):?>
        <?php if(($postedpost/$click)>20 ):?>
      <div class="form">
            <form action="" method="post" class="formLoad">
                <input type="submit" value="Load More" name="loadMore" class="button formLoad__button">
            </form>
        </div>  
    <?php endif;?>
   <?php endif;?>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="lib/js/loadMore.js"></script>
<script src="lib/js/location.js"></script>
<script src="lib/js/like.js"></script>

</body>
</html>
