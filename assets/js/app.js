(function($){

// ========================================== uploadImage.php =================================================

/**
 * Uploadds the image
 *
 * @param formData object new FormData
 *
 *
 * @return true
 */
function uploadImage(formData) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.status === 200) {
			alert("message has been sent"  + xhr.responseText); 
			return true;
		} 
		else {
			alert("an error has occured");
			return false;
		}
	}
	xhr.open('POST', '', true);
	xhr.send(formData);
}


// Get Image Form Elements
uploadImageForm = document.getElementById("image-upload-form");
uploadImageFile = document.getElementById("image-upload--file");
uploadImageSize = document.getElementById("image-upload--size");
uploadImageButton = document.getElementById("image-upload--button");


// When imageUpload button is clicked, perform upload
uploadImageForm.onsubmit = function(event) {

	//event.preventDefault();
	var formData = new FormData();

	// Get Submitted Files
	uploaded_file = uploadImageFile.files[0];
	if(!uploaded_file.type.match('image*') ) {
		return false;
	} 
	else {
		formData.append(uploadImageFile.name, uploaded_file, uploaded_file.name);
	}
	formData.append(uploadImageSize.name, uploadImageSize.value); 
	uploadImage(formData);
}



	// Remember that ajax calls from the current page so you may have to use php to fill in the location of the ajax call.
	// $.ajax({
	// 	method : "POST",
	// 	url : "",
	// 	data : {userId : "guy", profilePicture : "title"},
	// 	success : function(response) {
	// 		alert("the response was" + response);
	// 	}
	// })




})(jQuery); 