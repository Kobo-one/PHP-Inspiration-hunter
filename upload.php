<?php 
    include_once("lib/classes/Image.class.php");
    include_once("lib/classes/Post.class.php");
    include_once("lib/includes/checklogin.inc.php");
    
    if( !empty($_POST) ){
        //if submit btn is clicked
        if(isset($_POST['submit'])){
        //if image is chosen
            try{
            if(isset($_FILES['image'])){
            
            //make new image & set variables
            $image = new Image();
            $image->setFileName($_FILES['image']['name']);
            $image->setFileSize($_FILES['image']['size']);
            $image->setFileTmp($_FILES['image']['tmp_name']);
            $image->setFileType($_FILES['image']['type']);
            $image->setFileDir("uploads/".$_FILES['image']['name']);
            $image->setFileExt(strtolower((explode('.',$_FILES['image']['name']))[count(explode('.',$_FILES['image']['name']))-1]));

            //get variables to upload and save image on database
            $fileTmp = $image->getFileTmp();
            $fileDir = $image->getFileDir();
            $fileName = $image->getFileName(); 
            $fileSize = $image->getFileSize();
            
            //upload image & save on database
            if( move_uploaded_file($fileTmp, $fileDir) ){
                
                //compress image if bigger than 2MB
                $imageDestination = "uploads/"."cp-".$fileName;
                if($fileSize > 2097152){
                    $compImage = $image->compressImage($imageDestination);
                } else {
                    $compImage = $fileDir;
                }
                
                //create new post
                $post = new Post();
                $post->setImage( $compImage );
                $post->setDescription( $_POST['description']);
                $post->createPost();
            }
            //after submitted, go to...
            header("Location: profile.php");
        }
        }
        catch(Exception $e){
            $error= $e->getMessage();
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
                
                <!-- Errors geven ivm foto-->
                <?php if(isset($error)): ?>
                		<div class="error">
                    		<p><?php echo $error; ?></p>
                		</div>
                <?php endif; ?>
                
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