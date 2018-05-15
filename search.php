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
    
    //als er in de zoekterm een '#' staat, voer dan dit uit
    if(strpos($input, "#") !== FALSE){
    $newInput = substr($input, 1);
    $inputTag = $post->setSearch($newInput );
      
    } 
    //hashtag maken als de zoekterm overeenkomt met tag uit DB 
      $hashtag = $post->searchForHashTag();

    $count=$post->checkFollower();
    if(isset($_POST['follow'])|isset($_POST['unfollow'])){
    if ($post->existFollow()==0){
        $newPost = $post->newFollow();
    }
    else{   
        if(isset($_POST['follow'])){
            $active=1;
        };
        if(isset($_POST['unfollow'])){
            $active=0;
        };
        $post->setFollowStatus($active);
        $post->editFollow();
    }

    }
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
    <link rel="shortcut icon" type="image/png" href="images/favicon.ico"/>
    
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
    
<!-- Als de zoekterm een hashtag, toon dan dit boven de resultaten -->  
<?php if(isset($collection)):?>
   <?php if($hashtag): ?>
    <?php if(isset($newInput) && $hashtag['tag'] == $newInput): ?> 
    <div class="hashtag_title" id="<?php echo htmlspecialchars($newInput); ?>"> <?php echo "#".htmlspecialchars($newInput); ?> </div>
    <?php endif; ?>
    <?php if(!isset($newInput) && $hashtag['tag'] == $input): ?>
    <div class="hashtag_title" id="<?php echo htmlspecialchars($input); ?>"> <?php echo "#".htmlspecialchars($input); ?> </div>
    <?php endif; ?>
    
    <form action="" method="post" class="col_search">
       <?php if($count == 0): ?>
        <input type="submit" value="Follow" class="button button--tag--follow" name="follow">
       
       <?php elseif($count >= 0): ?>
       <input type="submit" value="Unfollow" class="button button--tag--unfollow" name="unfollow">
       <?php endif; ?>
    </form>
<?php endif; ?>
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
            <figure class="<?php echo ($c['filter']);?> figure_index">
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
<script src="lib/js/tagFollow.js"></script>
<script src="lib/js/like.js"></script>

</body>
</html>