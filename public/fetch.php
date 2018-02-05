<?php
//fetch.php

	 include_once '../includes/db_connection.php';

	 if(isset($_POST["service_id"]))  
 {  
      $query = "SELECT * FROM services WHERE service_id = '".$_POST["service_id"]."'";  
      $result = mysqli_query($connection, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  

?>