<?php require_once("functions.php");?>
<?php
	if (isset($_POST['submit'])) {
		require_once 'session.php';
		session_unset();
		session_destroy();
		redirect_to("../public/index.php");

	}
?>