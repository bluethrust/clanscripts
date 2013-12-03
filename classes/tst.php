<?php
include_once("btupload.php");

if($_POST['submit']) {

	$btUploadObj = new BTUpload($_FILES['uploadfile'], "", "../", array(".jpg", ".png", ".bmp", ".gif"));
	
	if($btUploadObj->uploadFile()) {
		echo "File Uploaded!";	
	}
	else {
		echo "Unable to upload file!";
	}
	
	echo "<br><br>";

	print_r($_FILES);
	
	echo "<br><br>";
	
}


echo "
	<form action='tst.php' method='post' enctype='multipart/form-data'>
	
		<input type='file' name='uploadfile'><br>
		<input type='submit' name='submit' value='Upload'>
	
	</form>

";





?>