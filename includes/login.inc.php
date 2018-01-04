<?php require_once("session.php");?>
<?php require_once("functions.php");?>
<?php
	
	if (isset($_POST['submit'])) {
		include_once 'db_connection.php';

		$uid = mysql_prep($_POST['uid']);
		$pwd = mysql_prep($_POST['pwd']);

		//Error  handlers
		//Check if inputs are empty
		if (empty($uid) || empty($pwd)) {
			redirect_to("../public/index.php?login=empty");
		} else {
			$sql = "SELECT * FROM users WHERE user_uid = '$uid' OR user_email='$uid'";
			$result = mysqli_query($connection, $sql);
			$resultCheck = mysqli_num_rows($result);
			if ($resultCheck < 1) {
				redirect_to("../public/index.php?login=error");
			} else {
				if ($row = mysqli_fetch_assoc($result)) {
					//De-hashing the password
					$hashedPwdCheck = password_verify($pwd, $row['user_pwd']);

					if ($hashedPwdCheck == false) {
						redirect_to("../public/index.php?login=error");
					} elseif ($hashedPwdCheck == true) {
						//Log in the user here
						$_SESSION['u_id'] = $row['user_id'];
						$_SESSION['u_first'] = $row['user_first'];
						$_SESSION['u_last'] = $row['user_last'];
						$_SESSION['u_email'] = $row['user_email'];
						$_SESSION['u_uid'] = $row['user_uid'];
						$_SESSION['u_type'] = $row['user_type'];
						redirect_to("../public/index.php?login=success");

					}
				}
			}
		}

	} else {
		redirect_to("../public/index.php?login=error");
	}
?>