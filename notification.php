<?php
include_once("lib/classes/Notification.class.php");
include_once("lib/classes/User.class.php");
include_once("lib/includes/checklogin.inc.php");

$collection=Notification::getAll();

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
<div class="collection">
<?php foreach($collection as $c): ?>
    

    <div >
             <a href="profile.php?user=<?php echo $c['userId'] ?>"><img src="<?php echo htmlspecialchars($c['picture']); ?>" alt="avatar" class="avatar"></a>
              <a href="profile.php?user=<?php echo $c['userId'] ?>" class="username"><?php echo htmlspecialchars($c['username']); ?></a>
            
    </div>
        <a href="detail.php?post=<?php echo $c['userId'] ?>"><div><p>you have been tagged</p></div></a>
         <div ><p><?php echo $c['date'] ?></p></div>
    <?php endforeach; ?>
</div>

</body>
</html>
