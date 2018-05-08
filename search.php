<?php
include_once("lib/classes/Post.class.php");
include_once("lib/classes/User.class.php");
include_once("lib/classes/Like.class.php");
include_once("lib/includes/checklogin.inc.php");

if (!empty($_GET['search'])){  
    $input= $_GET['search'];
    
    try{   
    $post = new Post();
    $searchId=$post->setSearch($input);
    $collection= $post->getTag() ; 
    }

    catch(Exception $e){
        $error= $e->getMessage();
    }   
}
else {
    //als de search input leeg is -> blijf op dezelfde pagina
    header('Location: ' . $_SERVER['HTTP_REFERER']);


};
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    
    <title>Phomo | HOME</title>
</head>
<body>
   <?php include_once("nav.inc.php"); ?>
<!-- als er geen zoekresultaten zijn -> error -->
    <?php if (isset($error)):?>
                <div class="error error--index">
					<p>
						<?php echo $error ?>
					</p>
		        </div>
    <?php endif; ?>       
   <div class="collection">
   
<!-- kijken of er zoekresultaten zijn (anders komt er een foutmelding onder de error)--> 
<?php if(isset($collection)):?>
<?php foreach($collection as $key =>$c): ?>    
      <div class="item clearfix">
         <div class="user">
             <a href="profile.php?user=<?php echo $c['post_user_id'] ?>"><img src="<?php echo htmlspecialchars($c['picture']); ?>" alt="avatar" class="avatar"></a>
              <a href="profile.php?user=<?php echo $c['post_user_id'] ?>" class="username"><?php echo htmlspecialchars($c['username']); ?></a>
         </div>
         <div class="user__post">
         <a href="detail.php?post=<?php echo $c['id'] ?>">
            <figure class="<?php echo ($c['filter']);?>">
            <img src="<?php echo htmlspecialchars($c['image']); ?> " alt="image" class="picture_index">
            </figure>   
         </a>
</div>
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
<?php endif; ?>   
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="lib/js/like.js"></script>

</body>
</html>