<?php


	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES)) {

		require_once "../../controllers/routes.php";
		require_once "../../assets/classes/bulletproof/src/bulletproof.php";
		require_once "../../models/User.php";

		// $folderName = asset_route('dbimg');

		//remove the the old image if it exists
		unlink(/* path to file */);

		// Upload the new one

		$image = new Bulletproof\Image($_FILES);

		if($image["profilePicture"]) {
			 $image->setLocation("/var/www/html/reou/assets/img/dbimg");
			 $image->setSize(100, 4194304);
		    $upload = $image->upload();
		    echo $image->getName() . "." . $image->getMime();
		   

		    if($upload) {
		        // OK
		       echo "The file has been uploaded";
		       echo $_FILES['profilePicture']['name'];

		    } else {
		        echo $image["error"]; 
		    }
		}

	}

?>


<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
    <input type="file" name="profilePicture"/>
    <input type="submit" value="upload"/>
</form>


<!-- Load up jquery because I think its about to get serious -->
<script type="text/javascript" src="../../assets/js/jquery/dist/jquery.min.js"> </script>
<script type="text/javascript" src="../../assets/js/app.js"> </script>