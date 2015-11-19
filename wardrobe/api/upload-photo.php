<?php
$uploadSuccess = 0;
$allowedExts = array("jpeg","jpg","JPG","JPEG","png","PNG","GIF","gif");
$extension = end(explode(".", $_FILES["file"]["name"]));

// Check if file extension is valid
if (in_array($extension, $allowedExts)) {
	// Valid
	// Check if upload error
	if ($_FILES["file"]["error"] > 0) {
		// Upload error
		error_log('[Wardrobe] '.__FILE__.' line '.__LINE__.' : "photo upload error code '.$_FILES["file"]["error"].'"');
	} else {
		
		//echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		//echo "Type: " . $_FILES["file"]["type"] . "<br>";
		//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

		move_uploaded_file($_FILES["file"]["tmp_name"],"../images/".$username."/".$_FILES["file"]["name"]); // Move from xampp/php/tmp to desired directory
		if(file_exists("../images/".$username."/" . $_FILES["file"]["name"])) {
			// Result
			$photo = $_FILES["file"]["name"]; // Photo name
			$blob_image = file_get_contents("../images/".$username."/".$_FILES["file"]["name"]); // BLOB version
			//echo '<img src="data:image/jpg;base64,'.$blob_image_from_db.'"/>'; // Display BLOB to image
			$uploadSuccess = 1;
		} else {
			error_log('[Wardrobe] '.__FILE__.' line '.__LINE__.' : "move uploaded file error"');
		}
	}
// File extension not valid
} else {
	error_log('[Wardrobe] '.__FILE__.' line '.__LINE__.' : "invalid file type"');
}
?>