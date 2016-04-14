<?php


	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES)) {

		require_once "../../controllers/routes.php";
		require_once "../../assets/classes/bulletproof/src/bulletproof.php";
		require_once "../../models/User.php";

		//remove the the old image if it exists
		// unlink(/* path to file */);

		// Upload the new one




		$image = new Bulletproof\Image($_FILES);

		if($image["profilePicture"]) {
			 $image->setLocation("/var/www/html/reou/assets/img/dbimg");
			 $image->setSize(100, 4194304);
			 $image->setDimension(900, 900);
		    $upload = $image->upload();

		    echo $image->getName() . "." . $image->getMime();
		   

		    if($upload) {
		       echo "The file has been uploaded";
		    } else {
		        echo $image["error"]; 
		    }
		}

		die("image has been uploaded");

	}

?>


<form method="POST" id="image-upload-form" enctype="multipart/form-data">
    <input type="hidden" id="image-upload--size" name="MAX_FILE_SIZE" value="1000000"/>
    <input type="file" id="image-upload--file" name="profilePicture"/>
    <input type="submit" id="image-upload--button" value="upload"/>
</form>


<!-- Load up jquery because I think its about to get serious -->
<script type="text/javascript" src="../../assets/js/jquery/dist/jquery.min.js"> </script>
<script type="text/javascript" src="../../assets/js/app.js"> </script>