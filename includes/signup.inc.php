<?php require_once("../includes/functions.php");?>
<?php
	
	if (isset($_POST['submit'])) {
		include_once 'db_connection.php';

		$first = mysql_prep($_POST['first']);
		$last = mysql_prep($_POST['last']);
		$email = mysql_prep($_POST['email']);
		$uid = mysql_prep($_POST['uid']);
		$first = mysql_prep($_POST['first']);
		$pwd = mysql_prep($_POST['pwd']);
		$selectUser = mysql_prep($_POST['selectUser']);

		//Error handlers
		//Check for empty fields
		if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd) || $selectUser == "Choose...") {
			redirect_to("../public/signup.php?signup=empty");
		} else {
			//Check if input characters are valid
			if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
				redirect_to("../public/signup.php?signup=invalid");
			} else {
				//Check if email is valid
				if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
					redirect_to("../public/signup.php?signup=email");
				} else {
					$sql = "SELECT * FROM users WHERE user_uid = '$uid'";
					$result = mysqli_query($connection, $sql);
					$resultCheck = mysqli_num_rows($result);

					if ($resultCheck > 0) {
						redirect_to("../public/signup.php?signup=usertaken");
					} else {
						//Hashing the password
						$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
						//Insert the user into the database
						$sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd, user_type) VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd', '$selectUser')";
						mysqli_query($connection,$sql);
						redirect_to("../public/signup.php?signup=success");
					}
				}
			}

		}

	} else {
		redirect_to("../public/signup.php");
	}
?>