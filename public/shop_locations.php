<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  
    include_once '../includes/db_connection.php';
  
    $id = 0;
    $shop_name = '';
    $shop_image = '';
    $shop_description = '';
    $shop_contact = '';
    $shop_schedule = '';
    $shop_category = '';

    if (isset($_GET['myshop'])) {
    $id = $_GET['myshop'];
    $rec = mysqli_query($connection,"SELECT * FROM shops WHERE shop_id = $id");
    $record = mysqli_fetch_array($rec);
    $id = $record['shop_id'];
    $shop_name = $record['shop_name'];
    $shop_image = $record['shop_image'];
    $shop_description = $record['shop_description'];
    $shop_contact = $record['shop_contact'];
    $shop_schedule = $record['shop_hours'];
    $shop_category = $record['shop_category'];


  }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Fixpertr</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/mystyles.css">
  </head>
  <body id="shop_locations">
    

  <?php include '../includes/layouts/provider_header.php';?>


      <div class=" content container">
        
        <h1><span class="glyphicon glyphicon-map-marker"></span> Shop Locations</h1>
       
      </div>
  

    <?php include '../includes/layouts/footer.php';?>