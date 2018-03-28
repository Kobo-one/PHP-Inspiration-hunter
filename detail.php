<?php
include_once("lib/classes/Post.class.php");

$post = new Post();
$id=$post->setSearch($_GET['post']);

$collection= $post->getDetailsPost();
var_dump($collection);
/*"1" ["image"]=> string(168) "https://images.unsplash.com/photo-1519221584559-dea13724c873?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=b02ef53080a2d07699d854cf9a528c45&auto=format&fit=crop&w=934&q=80" ["description"]=> string(8) "Mooimooi" ["post_user_id"]=> string(1) "1" ["created"]=> string(19) "2018-03-27 02:00:00" ["deleted"]=> string(1) "" ["firstname"]=> string(4) "Kobe" ["lastname"]=> string(13) "Christiaensen" ["picture"]=> string(60) "https://netasite.net/wp-content/uploads/2013/05/90d95000.jpg" } } 
    */

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
              <img src="<?php echo $c['picture'];?>" alt="avatar" class="avatar">
              <a href="profile.php?user=<?php echo $id;?>"><?php var_dump( $collection[$id]['firstname']). " ". $collection['lastname']?></a>
         </div>
<?php foreach($collection as $key =>$c): ?>      
         <a href="#"><img src="<?php echo $c['image'];?>" alt="image" class="picture_index"></a>
         
         <div id="detail_photo_text">
         <div class="date"><?php ?></div>
         <div class="likes">Likes</div>
         <div class="comments"><strong>Username:</strong> Oh My God! Cool pic!</div>
         </div>
      </div>
	</div>
<?php endforeach; ?>
</body>
</html>