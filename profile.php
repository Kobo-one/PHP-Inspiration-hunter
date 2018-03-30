<?php
include_once("lib/classes/Post.class.php");

$post = new Post();
$id=$_GET['user'];
$post->setIdG($id);

$collection= $post->getDetailsProfile();

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
	   
	   
<div id="main_user">

  <div class="user">
              <img src="<?php echo $collection[0]['picture']?>" alt="avatar" class="avatar">
              
         </div>
         <h1><?php echo $collection[0]['username'] ?></h1>
         </div>
         
        <div id="profile_info">
         <div class="extra">aantal posts</div>
         <div class="extra">aantal volgers</div>
         <div class="extra">aantal volgend</div>
         
         </div>



<div id="posts_profile" class="collection">
	  <!-- BEGIN LOOP FROM DB -->
      <?php foreach($collection as $key =>$c): ?> 
      <div class="item clearfix">
         
         <a href="#"><img src="<?php echo $c['image']?>" alt="image" class="picture_index"></a>
         
        <div id="detail_photo_text">
         
         <div class="date"><?php echo $c['created']?></div>
         <div class="likes">Likes</div>
         <div class="comments"><strong>Username:</strong> Oh My God! Cool pic!</div>
         
         </div>
      </div>
<?php endforeach; ?>
      <!-- testcontent 
      <div class="item clearfix">
         
          <a href="#"><img src="https://images.unsplash.com/photo-1515342870411-fdedf6a7c373?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=3f4e0f48166791d198e5cc2d9a8419b6&auto=format&fit=crop&w=962&q=80" alt="image" class="picture_index"></a>
         <div id="detail_photo_text">
         
         <div class="date">17/03/2018</div>
         <div class="likes">Likes</div>
         <div class="comments"><strong>Username:</strong> Oh My God! Cool pic!</div>
         
         </div>
      </div>
      
      <div class="item clearfix">
       
          <a href="#"><img src="https://images.unsplash.com/photo-1494797262163-102fae527c62?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=0f06672063bb4021d19469dd62e5a1d9&auto=format&fit=crop&w=1000&q=80" alt="image" class="picture_index"></a>
        <div id="detail_photo_text">
         
         <div class="date">17/03/2018</div>
         <div class="likes">Likes</div>
         <div class="comments"><strong>Username:</strong> Oh My God! Cool pic!</div>
         
         </div>
      </div>
      
      <div class="item clearfix">
        
          <a href="#"><img src="https://images.unsplash.com/photo-1514908162061-89747fab8b1e?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=fb9e2cc4a906ae0c1685939dcb4c82a3&auto=format&fit=crop&w=2100&q=80" alt="image" class="picture_index"></a>
         <div id="detail_photo_text">
         
         <div class="date">17/03/2018</div>
         <div class="likes">Likes</div>
         <div class="comments"><strong>Username:</strong> Oh My God! Cool pic!</div>
         
         </div>
      </div>
      
      <div class="item clearfix">
         
          <a href="#"><img src="https://images.unsplash.com/photo-1512794751227-fefb9f898224?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=ed90dfd9d5890d4edd8a9288d940572e&auto=format&fit=crop&w=2100&q=80" alt="image" class="picture_index"></a>
        <div id="detail_photo_text">
         
         <div class="date">17/03/2018</div>
         <div class="likes">Likes</div>
         <div class="comments"><strong>Username:</strong> Oh My God! Cool pic!</div>
         
         </div>
      </div>
      
      <div class="item clearfix">
        
          <a href="#"><img src="https://images.unsplash.com/photo-1516203294340-5ba5f612dc6a?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=1b79294f231ab4799218e82818a07de1&auto=format&fit=crop&w=1770&q=80" alt="image" class="picture_index"></a>
        <div id="detail_photo_text">
         
         <div class="date">17/03/2018</div>
         <div class="likes">Likes</div>
         <div class="comments"><strong>Username:</strong> Oh My God! Cool pic!</div>
         
         </div>
      </div>
      
      <div class="item clearfix">
         
          <a href="#"><img src="https://images.unsplash.com/photo-1486570318579-054c95b01160?ixlib=rb-0.3.5&s=8cb4fb1b4ac3ab4e5335a6f5961d5d86&auto=format&fit=crop&w=2390&q=80" alt="image" class="picture_index"></a>
         <div id="detail_photo_text">
         
         <div class="date">17/03/2018</div>
         <div class="likes">Likes</div>
         <div class="comments"><strong>Username:</strong> Oh My God! Cool pic!</div>
         
         </div>
      </div>
      
      <div class="item clearfix">
         
          <a href="#"><img src="https://images.unsplash.com/photo-1478001517127-fccc92f54906?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=63597be27c598539afd0becc211be037&auto=format&fit=crop&w=2100&q=80" alt="image" class="picture_index"></a>
          
          
         <div id="detail_photo_text">
         
         <div class="date">17/03/2018</div>
         <div class="likes">Likes</div>
         <div class="comments"><strong>Username:</strong> Oh My God! Cool pic!</div>
         
         </div>
      </div>
    -->
	
</div>

</body>
</html>