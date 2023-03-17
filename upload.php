<?php
session_start();
include('server.php');
$member = $_SESSION['member'];
$file = mysqli_real_escape_string($conn,$_POST['change']);
$_SESSION["fileup"] = $file;
$output_dir = "upload/";/* Path for file upload */
	$RandomNum   = time();
	$ImageName      = str_replace(' ','-',strtolower($_FILES['image']['name'][0]));
	$ImageType      = $_FILES['image']['type'][0];

	$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
	$ImageExt       = str_replace('.','',$ImageExt);
	$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
	$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
    $ret[$NewImageName]= $output_dir.$NewImageName;

	/* Try to create the directory if it does not exist */
	if (!file_exists($output_dir))
	{
		@mkdir($output_dir, 0777);
	}

	move_uploaded_file($_FILES["image"]["tmp_name"][0],$output_dir."/".$NewImageName );
	   $sql = "INSERT INTO image(member,image)VALUES ('$member','$NewImageName')";
		if (mysqli_query($conn, $sql)) {
			echo "successfully !";
			$select = "SELECT image FROM image WHERE member = '$member' ORDER BY id DESC LIMIT 1";
			$result = mysqli_query($conn, $select);
			if (mysqli_num_rows($result) == 1) {
					header("location: uploadfile.php");
			}

		}
		else {
		echo "Error: " . $sql . "" . mysqli_error($cn);
	 }

?>
