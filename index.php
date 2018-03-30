<?php
include_once("lib/classes/Post.class.php");
$collection= Post::getAll();
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
                <div class="error">
					<p>
						<?php echo $error ?>
					</p>
		        </div>
 <?php endif; ?>
             
   <div class="collection">
<!--BEGIN FOTO'S UIT DATABASE-->  
<?php foreach($collection as $key =>$c): ?>    
      <div class="item clearfix">
         <div class="user">
              <img src="<?php echo $c['picture']; ?>" alt="avatar" class="avatar">
              <a href="profile.php?user=<?php echo $c['post_user_id'] ?>"><?php echo $c['username'] ?></a>
         </div>
         <a href="detail.php?post=<?php echo $c['id'] ?>"><img src="<?php echo $c['image']; ?> " alt="image" class="picture_index"></a>
         <div class="date"><?php echo $c['date'];?></div>
         <div class="likes">Likes</div>
      </div>
<?php endforeach; ?>
<!--EINDE-->
<!--
      <div class="item clearfix">
         <div class="user">
              <img src="https://images.unsplash.com/profile-1501760727417-d777ab88d48b?dpr=2&auto=format&fit=crop&w=128&h=128&q=60&cs=tinysrgb&crop=faces&bg=fff" alt="avatar" class="avatar">
              <a href="#">Joshua K. Jackson</a>
         </div>
         <a href="detail.php"><img src="https://images.unsplash.com/photo-1519221584559-dea13724c873?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=b02ef53080a2d07699d854cf9a528c45&auto=format&fit=crop&w=934&q=80" alt="image" class="picture_index"></a>
         <div class="date">17/03/2018</div>
         <div class="likes">Likes</div>
      </div>
      
      <div class="item clearfix">
         <div class="user">
              <img src="https://images.unsplash.com/profile-1513793286686-ffceabb07446?dpr=2&auto=format&fit=crop&w=128&h=128&q=60&cs=tinysrgb&crop=faces&bg=fff" alt="avatar" class="avatar">
              <a href="#">Joanna Nix</a>
         </div>
          <a href="detail.php"><img src="https://images.unsplash.com/photo-1515342870411-fdedf6a7c373?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=3f4e0f48166791d198e5cc2d9a8419b6&auto=format&fit=crop&w=962&q=80" alt="image" class="picture_index"></a>
         <div>
         <div class="date">16/03/2018</div>
         <div class="likes">Likes</div>
         </div>
      </div>
      
      <div class="item clearfix">
         <div class="user">
              <img src="https://images.unsplash.com/profile-fb-1493856381-a866fecb3f59.jpg?dpr=2&auto=format&fit=crop&w=128&h=128&q=60&cs=tinysrgb&crop=faces&bg=fff" alt="avatar" class="avatar">
              <a href="#">Yeshi Kangrang</a>
         </div>
          <a href="detail.php"><img src="https://images.unsplash.com/photo-1494797262163-102fae527c62?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=0f06672063bb4021d19469dd62e5a1d9&auto=format&fit=crop&w=1000&q=80" alt="image" class="picture_index"></a>
         <div>
         <div class="date">17/03/2018</div>
         <div class="likes">Likes</div>
         </div>
      </div>
      
      <div class="item clearfix">
         <div class="user">
              <img src="https://images.unsplash.com/profile-1511531310545-5f75d4e036cd?dpr=2&auto=format&fit=crop&w=128&h=128&q=60&cs=tinysrgb&crop=faces&bg=fff" alt="avatar" class="avatar">
              <a href="#">Frank Holleman</a>
         </div>
          <a href="detail.php"><img src="https://images.unsplash.com/photo-1514908162061-89747fab8b1e?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=fb9e2cc4a906ae0c1685939dcb4c82a3&auto=format&fit=crop&w=2100&q=80" alt="image" class="picture_index"></a>
         <div>
         <div class="date">17/03/2018</div>
         <div class="likes">Likes</div>
         </div>
      </div>
      
      <div class="item clearfix">
         <div class="user">
              <img src="https://images.unsplash.com/profile-fb-1512679809-8dffcb28bd09.jpg?dpr=2&auto=format&fit=crop&w=128&h=128&q=60&cs=tinysrgb&crop=faces&bg=fff" alt="avatar" class="avatar">
              <a href="#">Jenner VandenHoek</a>
         </div>
          <a href="detail.php"><img src="https://images.unsplash.com/photo-1512794751227-fefb9f898224?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=ed90dfd9d5890d4edd8a9288d940572e&auto=format&fit=crop&w=2100&q=80" alt="image" class="picture_index"></a>
         <div>
         <div class="date">15/03/2018</div>
         <div class="likes">Likes</div>
         </div>
      </div>
      
      <div class="item clearfix">
         <div class="user">
              <img src="https://images.unsplash.com/profile-1458892187889-bf07ba5d4145?dpr=2&auto=format&fit=crop&w=128&h=128&q=60&cs=tinysrgb&crop=faces&bg=fff" alt="avatar" class="avatar">
              <a href="#">Nick Stephenson</a>
         </div>
          <a href="detail.php"><img src="https://images.unsplash.com/photo-1516203294340-5ba5f612dc6a?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=1b79294f231ab4799218e82818a07de1&auto=format&fit=crop&w=1770&q=80" alt="image" class="picture_index"></a>
         <div>
         <div class="date">16/03/2018</div>
         <div class="likes">Likes</div>
         </div>
      </div>
      
      <div class="item clearfix">
         <div class="user">
              <img src="https://images.unsplash.com/profile-1486569543016-00973bbe85d8?dpr=2&auto=format&fit=crop&w=128&h=128&q=60&cs=tinysrgb&crop=faces&bg=fff" alt="avatar" class="avatar">
              <a href="#">Dahee Son</a>
         </div>
          <a href="detail.php"><img src="https://images.unsplash.com/photo-1486570318579-054c95b01160?ixlib=rb-0.3.5&s=8cb4fb1b4ac3ab4e5335a6f5961d5d86&auto=format&fit=crop&w=2390&q=80" alt="image" class="picture_index"></a>
         <div>
         <div class="date">16/03/2018</div>
         <div class="likes">Likes</div>
         </div>
      </div>
      
      <div class="item clearfix">
         <div class="user">
              <img src="https://images.unsplash.com/profile-1516616871614-a1698c40e709?dpr=2&auto=format&fit=crop&w=128&h=128&q=60&cs=tinysrgb&crop=faces&bg=fff" alt="avatar" class="avatar">
              <a href="#">Joshua Earle</a>
         </div>
          <a href="detail.php"><img src="https://images.unsplash.com/photo-1478001517127-fccc92f54906?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=63597be27c598539afd0becc211be037&auto=format&fit=crop&w=2100&q=80" alt="image" class="picture_index"></a>
         <div>
         <div class="date">15/03/2018</div>
         <div class="likes">Likes</div>
         </div>
      </div>

   </div> 
    
    
   --> 
    
</body>
</html>
