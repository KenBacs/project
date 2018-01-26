<?php require_once("session.php");?>
<?php require_once("functions.php");?>

<?php

	include_once '../includes/db_connection.php';
	
	 $msg = '';
     $msgClass = '';


	if (isset($_POST['submit'])) {

		

		$user_id = mysql_prep($_SESSION['u_id']);
		$shop_name = mysql_prep($_POST['shop_name']);

		$file = $_FILES['file'];

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



		
		

		if (!empty($shop_name) && !empty($shop_description) && !empty($file) && !empty($shop_contact) && !empty($shop_schedule) && !empty($shop_category) ) {	

				$sql = "SELECT * FROM shops WHERE shop_name = '$shop_name'";
	          	$resultsn = mysqli_query($connection, $sql);
	          	$resultCheck = mysqli_num_rows($resultsn);

	          	if ($resultCheck > 0) {
	          		$_SESSION['msg'] ="Shop name is already taken";
					$_SESSION['msgClass'] ="alert-danger";
					redirect_to("../public/create_shop.php");
	          	} else {
	          		if (preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $shop_contact)) {
	          			

					    if (in_array($fileActualExt, $allowed)) {
					      if ($fileError === 0) {
					        if ($fileSize < 1000000) {
					          $fileNameNew = uniqid('',true).".".$fileActualExt;
					          $fileDestination = 'images/'.$fileNameNew;
					          move_uploaded_file($fileTmpName, $fileDestination);
					          header("Location: create_shop.php?uploadsuccess");
					        } else {
					         	$_SESSION['msg'] ="Image file is too big";
								$_SESSION['msgClass'] ="alert-danger";
								redirect_to("../public/create_shop.php");
				        }
					      } else {
					        $_SESSION['msg'] ="There was an error uploading your file";
							$_SESSION['msgClass'] ="alert-danger";
							redirect_to("../public/create_shop.php");
					      }
					    } else {
					      	$_SESSION['msg'] ="Invalid image";
							$_SESSION['msgClass'] ="alert-danger";
							redirect_to("../public/create_shop.php");

					    }

	          		} else {
	          			$_SESSION['msg'] ="Invalid telephone number";
						$_SESSION['msgClass'] ="alert-danger";
						redirect_to("../public/create_shop.php");
	          		}

	          	}
				

          	} else {

			$_SESSION['msg'] ="Please fill all fields";
			$_SESSION['msgClass'] ="alert-danger";
			redirect_to("../public/create_shop.php");

		}
	}



?>