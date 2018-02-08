<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
//insert.php  
 include_once '../includes/db_connection.php';

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $shop_id = $_GET['shop'];
   
    mysqli_query($connection,"DELETE FROM services WHERE service_id = $id") or die(mysqli_error($connection)); 

       
  }
?>