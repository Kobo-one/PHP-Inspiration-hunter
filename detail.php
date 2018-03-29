<?php
include_once("lib/classes/Post.class.php");

$post = new Post();
$id=$_GET['post'];
$post->setSearch($id);

$collection= $post->getDetailsPost();


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<title>Phomo | Details</title>
</head>
<body>
  <?php include_once("nav.inc.php"); ?>
  <?php foreach($collection as $key =>$c): ?> 
  <div id="detail_photo">
      <div class="item clearfix">
         <div class="user">
              <img src="<?php echo $c['picture'];?>" alt="avatar" class="avatar">
              <a href="profile.php?user=<?php echo $c['post_user_id'];?>"><?php echo( $c['username']);?></a>
         </div>
     
         <a href="#"><img src="<?php echo $c['image'];?>" alt="image" class="picture_index"></a>
         
         <div id="detail_photo_text">
         <div class="date"><?php echo $c['created'] ?></div>
         <div class="likes">Likes</div>
         <div class="comments"><strong>Username:</strong> Oh My God! Cool pic!</div>
         </div>
      </div>
	</div>
<?php endforeach; ?>
</body>
</html>