<?php include_once("lib/classes/Notification.class.php");?>
<nav class="navbar">
    <a href="index.php">
           <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
       
       
        <img src="images/logoklein_phomo.png" alt="Phomo logo" class="logonav">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cssgram/0.1.10/cssgram.min.css">
    <link rel="shortcut icon" type="image/png" href="images/favicon.ico"/>

    </a>

    <a href="upload.php">Upload</a>
    <a href="profile.php">Profile <div class="bullet" style="display:
    <?php if(count(Notification::getUnseen())== 0){
        
        echo('none');}?>"></div></a>
    <a href="logout.php">Logout</a>
    <form action="search.php" method="get">
        <input type="text" name="search" id="searchfield" placeholder="Search">
    </form>
</nav>