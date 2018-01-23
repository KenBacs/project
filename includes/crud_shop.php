<?php require_once("../includes/functions.php");?>
<?php
	$shop_name = "";
	$file = "";
	$shop_description = "";
	$shop_contact = "";
	$shop_schedule = "";
	$shop_category = "";


	if (isset($_POST['submit'])) {

		include_once ('../includes/db_connection.php');
		$shop_name = mysql_prep($_POST['shop_name']);
		$file = $FILES['file'];

		$fileName = $_FILES['file']['name'];
		$fileTmpName = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg', 'jpeg', 'png', 'pdf');

		$shop_description = mysql_prep($_POST['shop_desc']);
		$shop_contact = mysql_prep($_POST['shop_contact']);
		$shop_schedule = mysql_prep($_POST['shop_schedule']);
		$shop_category = mysql_prep($_POST['selectCategory']);

		if (!empty($shop_name) && !empty($shop_description) && !empty($shop_contact) && !empty($shop_schedule) && !empty($shop_category) ) {	

			$sql = "SELECT * FROM shops WHERE shop_name = '$shop_name'";
          	$resultsn = mysqli_query($connection, $sql);
          	$resultCheck = mysqli_num_rows($resultsn);

          	if ($resultCheck > 0) {
          		//Failed Shop name is already taken
          	} else {
          		//Passed

          	}

		} else {

			//Failed  'Please fill in all fields'

		}
		if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 1000000) {
					$fileNameNew = uniqid('',true);.".".$fileActualExt;
					$fileDestination = 'images/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					header("Location: index.php?uploadsucess");

				} else {
					// Failed 'Your file is too big!';
				}
			} else {
				//Failed 'There was an error uploading your file!'
			}
		} else {
			//Failed 'You cannot upload file of this type!'
		}
	}

	// Retrieve records
	$results = mysqli_query($connection, "SELECT * FROM shops");
?>