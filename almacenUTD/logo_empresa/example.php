<?php
if(isset($_POST['submit'])){
	require 'class.imageupload.php';
	
	//$image = new ImageUloader($max_size, $max_width, $max_height, $upload_dir)
	$image = new ImageUploader(26, 200, 150, 'images/avatar/'); //1. maximum image size in kb(kilo byte), 2. maximum image width
																//3. maximum image height, 4. upload dir
	
	$image->setImage('input_field_name'); //name of your input image field name
	
	if(!$image->checkSize()) //check image size
		$errors[] = "File size is Big";
		
	if(!$image->checkHeight()) //check image height
		$errors[] = "File height is Big";
		
	if(!$image->checkWidth()) //check image width
		$errors[] = "File width is Big";
		
	if(!$image->checkExt()) //check image extension
		$errors[] = "File ext is not supported";
		
	if(!isset($errors)){
		$image->setImageName($userid); //set image name
		$image->deleteExisting();
		$image->upload();
		
		echo "<h2>Avatar Changed Successfully</h2>";
	}
	else{
		echo "<h2>You must correct the errors to proceed</h2><br>";
		print_r($errors);
	}
}
?>

<form enctype="multipart/form-data" action="" method="POST">
	<input name="input_field_name" type="file" />
    <input type="submit" name="submit" value="Change Avatar" />
</form>