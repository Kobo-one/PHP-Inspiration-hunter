<!DOCTYPE html>
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
                    <input type="file" name="image_upload" id="image_upload">
                </div> 
                <div class="formfield">
					<textarea id="description" rows="4" placeholder="Description"></textarea>
				</div>  
                <div class="formfield">  
                    <input type="submit" value="Upload" name="submit" class="button">
                </div>    
                    
                </form>
						
				
	</div>	
</body>
</html>