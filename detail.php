<?php
include_once("lib/classes/Post.class.php");
include_once("lib/includes/functions.inc.php");
include_once("lib/includes/checklogin.inc.php");
include_once("lib/classes/Comment.class.php");

$post = new Post();
$id=$_GET['post'];
$post->setIdG($id);
$post->setComment($id);
$collection= $post->getDetailsPost();

$comment = new Comment();
if(isset($_POST['btnAddComment'])){
    try {
        $comment->setText($_POST['text']);
        $comment->setPostId($_GET['post']);
        $comment->saveComment();
    }
    catch(Exception $e) {
        $feedback['text'] = $e->getMessage();
        $feedback['status'] = "error";
    }
}
$allComments=$comment->getAllComments(); 


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
	
	<script src="js/loadComment.js"></script>
	<title>Phomo | Details</title>
</head>
<body>
  <?php include_once("nav.inc.php"); ?>
  
<div class="detail_photo">
        <div class="item">
            <div class="user">
                <img src="<?php echo $collection[0]['picture'];?>" alt="avatar" class="avatar">
                <a href="profile.php?user=<?php echo $collection[0]['post_user_id'];?>" class="username"><?php echo( $collection[0]['username']);?></a>
            </div>
     
            <a href="#"><img src="<?php echo $collection[0]['image'];?>" alt="image" class="picture_index"></a>
         
             <div class="item_text feed_flex">
                <div class="date"><?php echo timeAgo($collection[0]['created']) ?></div>
                
                <div class="likes"># likes</div>
                <a href="#"><img src="images/tolike_btn.png" alt="like button" class="like_btn"></a>          
            </div>
            <div class="item_description"><?php echo $collection[0]['description'];?></div>
        </div>
         <div class="comments" id="commentfeed">
        <?php foreach($allComments as $key => $comment): ?>          
        <div class="comment">
            <div class="comment_username"><?php echo $comment['username']; ?></div>
            <p><?php echo $comment['comment']; ?></p>
        </div>         
        <?php endforeach; ?>
      
       <div class="new_comment">
		<form action="" method="post">
			<textarea name="text" id="text"></textarea>
			<input type="submit" name="btnAddComment" id="btnAddComment" class="button" value="Add comment" />
		</form>
	    </div>
    </div>
</div>
</body>
</html>