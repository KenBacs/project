<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
include_once '../includes/db_connection.php';

// Gets data from URL parameters.
$shop = $_GET['shop'];
$name = $_GET['name'];
$address = $_GET['address'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];


// Opens a connection to a MySQL server.
/*$connection=mysql_connect ("localhost", $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}*/

// Sets the active MySQL database.
$db_selected = mysqli_select_db( $connection,DB_NAME);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($connection));
}

// Inserts new row with place data.
$query = "UPDATE markers SET name = '$name', address = '$address', lat = '$lat', lng = '$lng' WHERE id = $shop ";

$result = mysqli_query($connection,$query) or die(mysqli_error($connection));

if (!$result) {
  die('Invalid query: ' . mysqli_error($connection));
}

?>