<?php
include_once("lib/classes/Post.class.php");
include_once("lib/classes/User.class.php");
include_once("lib/classes/Like.class.php");
include_once("lib/includes/checklogin.inc.php");
$user = new User();
$id=$user->loggedinUser();
session_start();
$user->setId($id);

/* als je nog geen vrienden hebt-> toon posts met meeste likes
getFollowersAmount staat status niet op 1 dus als die op 0 staat werkt het nog niet*/

if($user->getFollowersAmount()==0){   
    $collection= Post::getTopPosts();
    $friendless="";
   
} 
/* als je al vrienden hebt -> toon posts van je vrienden */

else{
    /* als er minder dan 20 posts op de index pagina worden getoond -> aanvullen met populairste posts*/
    if(POST::allPost(21)->rowCount()<20){
        $friends= Post::getAll(21);
    
        $popular= Post::getTopPosts();
    
        $merge=array_merge($friends, $popular);
        $unique=array_unique($merge, SORT_REGULAR);
        $collection = array_slice($unique, 0, 19);
    }
    /* als er meer dan 20 posts worden getoond dan enkel posts vrienden tonen */
    else{
        $friends=Post::getAll(21);
        
        $collection=array_slice($friends,0,20);
        
        $click=1;
        if (isset($_POST['loadMore'])){
            $click++;
            echo("Dit is het aantal kilks".$click);
            $amount= ($click*20)+1;
            
            $friends=Post::getAll($amount);
        // var_dump($friends);
            array_pop($friends);
            $collection=$friends;
            //var_dump($collection);

        }
        $postedpost = count($friends);
    }
}


//$totalpost = Post::allPost()->rowCount();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    
   <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
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
    <?php if (isset($friendless)):?>
                <div class="noFriends">
                    <h2> It appears you don't have any friends yet!</h2>
                    <p>Search friends on their name or your interests. Or check out what other awesomeness people made below!</p>
                </div>
    <?php endif; ?>
    
                   
   <div id="map"></div>
    <script>


      function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            <?php
          if($_SESSION["lat"] !== 0 && $_SESSION["lng"] !== 0){
            echo "center: {lat: ".$_SESSION["lat"].", lng: ".$_SESSION["lng"]."},";
          }
          else{
            echo "center: {lat: 51.0261959, lng: 4.479992},";
          }
          
          ?>
          zoom: 13
        });
        <?php 
        foreach($collection as $key =>$c){

            if($c['lat']==0 && $c['lng']==0){

            }else{
                
            echo "var marker = new google.maps.Marker({
                    position: {lat: ".$c['lat'].", lng: ".$c['lng']."},
                    map: map,
                    title: 'Click to view post',
                    href: 'detail.php?post=".$c['id']."'
                });
            ";
            echo "marker.addListener('click', function() {
                    window.location.href = this.href;
                });";
            }
        }    
        ?>
              

      };

      
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5xUWTGWpKYSQhuYttFZQCNIgO77oOQmQ&callback=initMap">
    </script>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="lib/js/loadMore.js"></script>
<script src="lib/js/like.js"></script>
<script src="lib/js/location.js"></script>

</body>
</html>
