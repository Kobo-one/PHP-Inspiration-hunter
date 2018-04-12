<?php
include_once("lib/classes/Post.class.php");
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
  
    <?php if (isset($error)):?>
                <div class="error error--index">
					<p>
						<?php echo $error ?>
					</p>
		        </div>
    <?php endif; ?>       
   <div class="collection">
   
<!--BEGIN FOTO'S UIT DATABASE-->  
<?php if(isset($collection)):?>
<?php foreach($collection as $key =>$c): ?>    
      <div class="item clearfix">
         <div class="user">
             <a href="profile.php?user=<?php echo $c['post_user_id'] ?>"><img src="<?php echo $c['picture']; ?>" alt="avatar" class="avatar"></a>
              <a href="profile.php?user=<?php echo $c['post_user_id'] ?>" class="username"><?php echo $c['username'] ?></a>
         </div>
         <a href="detail.php?post=<?php echo $c['id'] ?>"><img src="<?php echo $c['image']; ?> " alt="image" class="picture_index"></a>
         <div class="feed_flex">
         <div class="date"><?php echo $c['created'];?></div>
         <div class="likes"># likes</div>
         <a href="#"><img src="images/tolike_btn.png" alt="like button" class="like_btn"></a>
         </div>
      </div>
<?php endforeach; ?>
<!--EINDE-->
        </div>
      <div class="form">
            <form action="" method="post" class="formLoad">
                <input type="submit" value="Load More" class=" button formLoad__button">
            </form>
        </div>  
<?php endif; ?>   
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="lib/js/loadMore.js"></script>

</body>
</html>