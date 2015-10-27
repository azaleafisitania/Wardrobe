<?php
$allowedExts = array("jpeg", "jpg", "png","gif");
$extension = end(explode(".", $_FILES["file"]["name"]));
$uploadSuccess = 0;

// Check extension
if (in_array($extension, $allowedExts)) {
	// Check if uploaded
	if ($_FILES["file"]["error"] > 0) {
		echo "Upload file error code#" . $_FILES["file"]["error"] . "<br>";
	} else {
		//echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		//echo "Type: " . $_FILES["file"]["type"] . "<br>";
		//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
		
		// Check if exists
		if (file_exists("../images/azalea/" . $_FILES["file"]["name"])) {
		?>
			<script>
			alert("File already exists");
			</script>
		<?php
		} else {
			// Move from temp to desired directory
			move_uploaded_file($_FILES["file"]["tmp_name"],"../images/azalea/" . $_FILES["file"]["name"]);
			//echo "Stored in: " . "images/azalea/" . $_FILES["file"]["name"];
			$uploadSuccess = 1;
		}
	}
} else {
	?>
		<script>
		alert("Invalid file type");
		</script>
	<?php
	}
?>