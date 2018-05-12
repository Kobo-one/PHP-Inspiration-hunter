<?php
include_once("lib/classes/Post.class.php");
include_once("lib/includes/checklogin.inc.php");
include_once("lib/classes/Comment.class.php");
include_once("lib/classes/User.class.php");
include_once("lib/classes/Like.class.php");
$user = new User();

//show post with details
$post = new Post();
$post->setIdG($_GET['post']);
if($post->inappropriateCheck()){
$collection= $post->getDetailsPost();
$collection = Post::setCities($collection);
//comments
$comment = new Comment();
$comment->setPostId($_GET['post']);
    
$comment->setUserId($_SESSION['user']);
$comment->commentUsername();
    
//add new comment and save to db
if(isset($_POST['btnAddComment'])){
    try {
        $comment->setText($_POST['text']);
        $comment->setUserId($_SESSION['user']);
        $comment->saveComment();
    }
    catch(Exception $e) {
        $feedback['text'] = $e->getMessage();
        $feedback['status'] = "error";
    }
}
$allComments=$comment->getAllComments(); 
$inappropriate = false;
}
else{
    $inappropriate = true;
}
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
	
	
	<title>Phomo | Details</title>
</head>
<body>
  <?php include_once("nav.inc.php"); ?>
  
<div class="detail_photo">
<?php if(!$inappropriate):?>
    <div class="item">
        <div class="user">
            <img src="<?php echo htmlspecialchars($collection[0]['picture']);?>" alt="avatar" class="avatar">
            <a href="profile.php?user=<?php echo $collection[0]['post_user_id'];?>" class="username"><?php echo htmlspecialchars($collection[0]['username']);?></a>
            <?php
            //check if post = post from loggedinUser, if so show edit btn
              if($user->loggedinUser() == $collection[0]['post_user_id']){
                echo '<div class="buttonedit"><a href="editPost.php?post=' . $collection[0]['id'] . ' ">Edit</a></div>';
              }
              else if($post->userFlagged()==0){
                echo '<div title="Flag this post as inappropriate" class="buttonedit inappropriate"><a href="#">Flag</a></div>';
              }
              else{
                echo '<div title="Unflag this post as inappropriate" class="button inappropriate" style="width: 80px; background-color: red;"><a href="#">Unflag</a></div>';
              }
            ?>
        </div>
     
  
            <figure class="<?php echo($collection[0]['filter']);?> figure_index">
            <img src="<?php echo  htmlspecialchars($collection[0]['image']);?>" alt="image" class="picture_index">
            </figure>

         
        <div class="item_text feed_flex">
            <div class="date"><?php echo Post::timeAgo($collection[0]['created'])."  -  ".$collection[0]['city']; ?></div>    
            <div class="likes"><span><?php echo Like::countLikes($collection[0]['id']);?></span> likes</div>
            <?php if (Like::userLiked($collection[0]['id'])==0):?>
                <a href="#"><img src="images/tolike_btn.png" alt="like button" class="like_btn" id="post_<?php echo $collection[0]['id'];?>"></a>
         
            <?php else:?>    
                <a href="#"><img src="images/liked_btn.png" alt="like button" class="like_btn" id="post_<?php echo $collection[0]['id'];?>"></a>
            <?php endif; ?>            
        </div>
        <div class="item_description"><?php echo Post::convertHashtoLink(htmlspecialchars($collection[0]['description']));?></div>
    </div>
        
    <div class="comments" id="commentfeed">
       
       <div class="new_comment" id="post_<?php echo $collection[0]['id'];?>">
		    <form action="" method="post">
                <textarea name="text" id="text"></textarea>
                <div class="search_comment"> </div>
			    <input type="submit" name="btnAddComment" id="btnAddComment" class="button" value="Add comment" />
		    </form>
	    </div>
      
       <div class="comments_list">
        <?php if(count($allComments) > 0): ?>
        <?php foreach($allComments as $key => $comment): ?>          
        
        <div class="comment" >
            <div class="comment_username"><?php echo htmlspecialchars($comment['username']); ?></div>
            <p><?php echo Comment::convertTagtoLink(htmlspecialchars($comment['comment'])); ?></p>
        </div>  
        <?php endforeach; ?>
		<?php endif; ?>
       </div>  
    </div>
    
    <?php else: ?>
    <div>
            <p>This post has been flagged inappropriate!</p>
    </div>
    <?php endif; ?> 
</div>

<script src="lib/js/loadComment.js"></script>
<script src="lib/js/like.js"></script>
<script src="lib/js/inappropriate.js"></script>
<script src="lib/js/tag.js"></script>
</body>
</html>