<?php
include_once("lib/classes/Post.class.php");

include_once("lib/includes/checklogin.inc.php");

$post = new Post();
$id=$_GET['post'];
$post->setIdG($id);
$post->setComment($id);
$collection= $post->getDetailsPost();

$comments=$post->getCommentsPost();

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
  
  <div id="detail_photo">
      <div class="item clearfix">
         <div class="user">
              <img src="<?php echo $collection[0]['picture'];?>" alt="avatar" class="avatar">
              <a href="profile.php?user=<?php echo $collection[0]['post_user_id'];?>"><?php echo( $collection[0]['username']);?></a>
         </div>
     
         <a href="#"><img src="<?php echo $collection[0]['image'];?>" alt="image" class="picture_index"></a>
         
         <div id="detail_photo_text">
         <div class="date"><?php $collection[0]['created'] ?></div>
         <div class="likes">Likes</div>
         <div class="detail__photo__description"><?php echo $collection[0]['description'];?></div>

<?php foreach($comments as $key =>$c): ?>          
         <div class="comments"><strong><?php echo $c['username']?>:</strong> <?php echo $c['comment']?></div>         
	
<?php endforeach; ?>
</div>
</body>
</html>