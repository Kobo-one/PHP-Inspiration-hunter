<?php 

/* SEARCH*/

if (isset($_GET['search'])){
	/*$search=$_GET['search'];
	$newCollection=[];
	foreach ($collection as $key => $c){
	  if (strpos(strtolower($c['description']), strtolower ($search)) !== false){
  $newCollection[$key] = $c;
      }
      */
      $post = new Post();
      $post->setSearch($_GET['search']);
      
      $newCollection=[];  
      foreach ($collection as $key => $c){
      if($post->getTag()!== NULL){
        $newCollection= $post->getTag(); 
        $newCollection[$key] = $c;
      }
    }

     
    
    $collection = $newCollection;

    

    

    
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
    <a href="">Logout</a>
    <form action="" method="get">
        <input type="text" name="search" id="searchfield" placeholder="Search">
    </form>
</nav>