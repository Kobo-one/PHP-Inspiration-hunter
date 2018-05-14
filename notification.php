<?php
include_once("lib/classes/Notification.class.php");
include_once("lib/classes/User.class.php");
include_once("lib/includes/checklogin.inc.php");
date_default_timezone_set("Europe/Brussels");

$collection=Notification::getAllNf();

if(count($collection)==0){
    $friendless="";
}


$date = date('Y-m-d H:i:s');
if (isset($date)){
    $notif= new Notification();
    $notif->setDate($date);
    $notif->setToSeen();
}
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
<?php if (isset($friendless)):?>
                <div class="noFriends">
                    <h2> It appears you don't have any notifications yet!</h2>
                    <p>Go ahead, tag some people and maybe they will return the favor!</p>
                </div>
    <?php endif; ?>
<div class="notif_container">
  
<?php foreach($collection as $c): ?>
<div class="notif_item" <?php if($c['seen']==0){echo('style="border:2px solid #41e1fc"');}; ?> >    
   
    <div class="notif_item-user">
        <a href="profile.php?user=<?php echo $c['userId'] ?>"><img src="<?php echo htmlspecialchars($c['picture']); ?>" alt="avatar" class="avatar"></a>
        <a href="profile.php?user=<?php echo $c['userId'] ?>" class="username"><?php echo htmlspecialchars($c['username']); ?></a>       
    </div>

         
    <a href="detail.php?post=<?php echo $c['post_id'] ?>" class="notif_item-text">
    <div >
        <p>You have been tagged</p>
        <p><?php echo $c['date'] ?></p>  
     </div>
     </a>
</form> 
</div>         
<?php endforeach; ?>
</div>

</body>
</html>
