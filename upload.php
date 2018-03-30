<?php 
    session_start();
    include_once("lib/classes/Post.class.php");

    if( !empty($_POST) ){
        //if submit btn is clicked
        if(isset($_POST['submit'])){
          
            if(isset($_FILES['image'])){
                $errors = array();
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];
                $file_dir="images/".$file_name;
                $parts = explode('.',$file_name);
                $file_ext=strtolower($parts[count($parts)-1]);



                $expensions= array("jpeg","jpg","png");

                if(in_array($file_ext,$expensions)=== false){
                    $errors[]="please choose a JPEG or PNG image.";
                }

                if($file_size > 2097152){
                    $errors[]='Image is bigger than 2MB';
                }

                if(empty($errors)==true){
                    if( move_uploaded_file($file_tmp,$file_dir)){
                        $post = new Post();
                        $post->setImage( $file_dir );
                        $post->setDescription( $_POST['description']);
                        $post->createPost();
                    }
                    echo "Success";
                }
                else{
                print_r($errors);
                }

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
	<title>Phomo | Upload inspiration</title>
</head>
<body>

<?php include_once("nav.inc.php"); ?>

<div id="upload_photo">


<h1>Wanna share some inspiration?</h1>

                <form action="" method="post" enctype="multipart/form-data">
                <div class="formfield">
                    <label for="image_upload" class="button">Choose image</label> 
                    <input type="file" name="image" id="image_upload" accept=".jpg, .jpeg, .png">
                </div>
                <div class="preview">
                <p>No image selected for upload</p>
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