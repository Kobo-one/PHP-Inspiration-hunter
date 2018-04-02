<?php 
    include_once("lib/classes/Post.class.php");
    include_once("lib/includes/checklogin.inc.php");
    include_once("lib/classes/Image.class.php");
    
    if( !empty($_POST) ){
        if(isset($_FILES['image'])){
                $errors = array();
                $image = new Image();
                $image->setFileName($_FILES['image']['name']);
                $image->setFileSize($_FILES['image']['size']);
                $image->setFileTmp($_FILES['image']['tmp_name']);
                $image->setFileType($_FILES['image']['type']);
                $image->setFileDir("images/".$_FILES['image']['name']);
                $parts = explode('.',$_FILES['image']['name']);
                $fileExt = strtolower($parts[count($parts)-1]);
                $expensions= array("jpeg","jpg","png");

                if(in_array($fileExt,$expensions)=== false){
                    $errors[]="please choose a JPEG or PNG image.";
                }

                if($fileSize > 2097152){
                    //$image->compress_image($fileTmp, $fileDir, 80);
                    $errors[]='Image is bigger than 2MB';

                }
        }
        //if submit btn is clicked
        if(isset($_POST['submit'])){
                 if(empty($errors)==true){
                    if( move_uploaded_file($fileTmp,$fileDir)){
                        $post = new Post();
                        $post->setImage( $fileDir );
                        $post->setDescription( $_POST['description']);
                        $post->createPost();
                    }
                    //na submit doorverwijzen naar profile.php
                    header("Location: profile.php");
                }
                else{
                print_r($errors);
                }
            }
        }

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style/reset.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="lib/js/previewUpload.js"></script>
	<title>Phomo | Upload inspiration</title>
</head>
<body>

<?php include_once("nav.inc.php"); ?>

<div class="upload_photo">


<h1>Wanna share some inspiration?</h1>

                <form action="" method="post" enctype="multipart/form-data" id="uploadForm">
                <div class="preview">
                <p id="no_image">No image selected for upload</p>
                </div>  
                
                <div class="formfield" id="first_input">
                    <label for="image_upload" class="button_upload" id="choose_image">Choose image</label>
                    <input type="file" name="image" id="image_upload" accept=".jpg, .jpeg, .png" onchange="filePreview(this);">
                </div>
                
                <div class="formfield">
					<textarea name="description" id="description" rows="4" placeholder="Description"></textarea>
				</div>  
                <div class="formfield">  
                    <input type="submit" value="Upload post" name="submit" class="button">
                </div>    
                    
                </form>
						
				
	</div>	
</body>
</html>