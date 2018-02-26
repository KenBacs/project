<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  
    include_once '../includes/db_connection.php';
  
    
    $id = 0;
    $shop_name = '';
    $fileNameNew = '';
    $shop_description = '';
    $shop_contact = '';
    $day_start = '';
    $day_end = '';
    $time_start = '';
    $time_end = '';
    $shop_category = '';


    if (isset($_GET['myshop'])) {
    $shop_id = $_GET['myshop'];
    $rec = mysqli_query($connection,"SELECT * FROM shops,shop_categories WHERE shop_id = $shop_id AND shops.shop_cat_id = shop_categories.shop_cat_id");
    $record = mysqli_fetch_array($rec);
    $shop_id = $record['shop_id'];
    $shop_name = $record['shop_name'];
    $shop_image = $record['shop_image'];
    $shop_description = $record['shop_description'];
    $shop_contact = $record['shop_contact'];
    $day_start = $record['day_start'];
    $day_end = $record['day_end'];
    $time_start = date("g:i a", strtotime($record['time_start'])); ;
    $time_end = date("g:i a", strtotime($record['time_end'])); 
    $shop_category = $record['shop_category'];
   
  }

  //Retrieve markers
  $results = mysqli_query($connection, "SELECT * FROM markers WHERE shop_id = $shop_id") or die(mysqli_error($connection));
  $resultCheck = mysqli_num_rows($results);
  echo $resultCheck
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

       <!-- JQUERY -->
    <script src="javascripts/jquery-3.2.1.min.js"></script>
  </head>
  <body id="shop_locations">
    

  <?php include '../includes/layouts/provider_header.php';?>


      <div class=" content container">

        <div class="row">

            <div class="col-sm-12">
                    <?php   $resultCheck = mysqli_num_rows($results);
                        if ($resultCheck < 1): ?>
                    <script type="text/javascript">

                      $(function() { $("#nolocations").modal('show'); });

                    </script>

              <?php endif ?> 
        
            </div>
        </dir>
          
        <h1><span class="glyphicon glyphicon-map-marker"></span> Shop Locations</h1>
       
      </div>

          <!-- Modal -->
  <div class="modal fade" id="nolocations" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" ><span class="glyphicon glyphicon-floppy-remove"></span></span> Oops! You don't have any location yet!</span></h4>
        </div>
        <div class="modal-body">
       
            <div class="alert alert-info">
        <strong>Info!</strong> Location is essential, so the customers know where is your shop.
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
        </div>
      </div>
      
    </div>
  </div>
  

    <?php include '../includes/layouts/footer.php';?>