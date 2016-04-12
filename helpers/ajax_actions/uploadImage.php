<?php


	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES)) {

		require_once "../../controllers/routes.php";
		require_once "../../assets/classes/bulletproof/src/bulletproof.php";

		// $folderName = asset_route('dbimg');

		$image = new Bulletproof\Image($_FILES);

		if($image["ikea"]) {
			 $image->setLocation("/var/www/html/reou/assets/img/dbimg");
		    $upload = $image->upload();
		    echo $image->getName() . "." . $image->getMime();
		   

		    if($upload) {
		        // OK
		       echo "The file has been uploaded";
		       echo $_FILES['ikea']['name'];
		    } else {
		        echo $image["error"]; 
		    }
		}

	}

?>


<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
    <input type="file" name="ikea"/>
    <input type="submit" value="upload"/>
</form>


<!-- Load up jquery because I think its about to get serious -->
<script type="text/javascript" src="../assets/js/jquery/dist/jquery.min.js"> </script>
<script type="text/javascript" src="../assets/js/app.js"> </script>