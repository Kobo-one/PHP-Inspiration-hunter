<?php 

/* SEARCH*/
// if input field is empty do nothing
if (!empty($_GET['search'])){  
    try{
    $post = new Post();
    $post->setSearch($_GET['search']);

    $collection= $post->getTag() ;
    }
    catch(Exception $e){
        $error= $e->getMessage();
    }  
};

?><nav class="navbar">
    <a href="index.php">
           <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">

       
       
        <img src="images/logoklein_phomo.png" alt="Phomo logo" class="logonav">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    </a>

    <a href="upload.php">Upload</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php">Logout</a>
    <form action="" method="get">
        <input type="text" name="search" id="searchfield" placeholder="Search">
    </form>
</nav>