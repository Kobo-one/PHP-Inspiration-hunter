<?php

include_once("lib/classes/Post.class.php");
include_once("lib/includes/checklogin.inc.php");
$collection= Post::getAll();
$counter=0;
/*object(DateInterval)#11 (16) {
     ["y"]=> int(0)
      ["m"]=> int(0)
       ["d"]=> int(14) 
       ["h"]=> int(3) 
       ["i"]=> int(10) 
       ["s"]=> int(17) ["f"]=> float(0.429323) ["weekday"]=> int(0) ["weekday_behavior"]=> int(0) ["first_last_day_of"]=> int(0) ["invert"]=> int(1) ["days"]=> int(14) ["special_type"]=> int(0) ["special_amount"]=> int(0) ["have_weekday_relative"]=> int(0) ["have_special_relative"]=> int(0) } 14 day(s) ago */

function timeAgo($pTime){
// tijdzone veranderen naar brusselse
    date_default_timezone_set("Europe/Brussels");
    
$postTime = new DateTime($pTime);
$currentTime = new DateTime();

//verschil tussen timestamp post en current time
$interval = $currentTime->diff($postTime);


if ($interval->h==0  && $interval->d==0 && $interval->m==0){
    return $interval->format('%i minute(s) ago')."\n";
}
if ($interval->d==0 && $interval->m==0 && $interval->h>=1){
    return $interval->format('%h hour(s) ago')."\n";
}
if($interval->m==0 && $interval->y==0){
    return $interval->format('%a day(s) ago')."\n";
}
if($interval->y==0){
    return $interval->format('%m month(s), %d day(s) ago');
}
if($interval->y>=1){
    return $interval->format('%y year(s), %m month(s) ago');
}

}

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
<?php foreach($collection as $key =>$c): ?>    
      <div class="item clearfix">
         <div class="user">
             <a href="profile.php?user=<?php echo $c['post_user_id'] ?>"><img src="<?php echo $c['picture']; ?>" alt="avatar" class="avatar"></a>
              <a href="profile.php?user=<?php echo $c['post_user_id'] ?>" class="username"><?php echo $c['username'] ?></a>
         </div>
         <a href="detail.php?post=<?php echo $c['id'] ?>"><img src="<?php echo $c['image']; ?> " alt="image" class="picture_index"></a>
         <div class="feed_flex">
         <div class="date"><?php echo(timeAgo($c['created']));?></div>
         <div class="likes"># likes</div>
         <a href="#"><img src="images/tolike_btn.png" alt="like button" class="like_btn"></a>
         </div>
      </div>
      <?php $counter++; ?>
<?php endforeach; ?>
<!--EINDE-->
        </div>
        <!-- Loadmore knop enkel tonen als er 20 resultaten zijn -->
        <?php if($counter >= 20 ):?>
      <div class="form">
            <form action="" method="post" class="formLoad">
                <input type="submit" value="Load More" class=" button formLoad__button">
            </form>
        </div>  

   <?php endif;?>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="lib/js/loadMore.js"></script>

</body>
</html>
