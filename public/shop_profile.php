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

    if (isset($_GET['view'])) {
    $id = $_GET['view'];
    $edit_state=true;
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

    // Retrieve services
    $service_results = mysqli_query($connection, "SELECT * FROM services WHERE shop_id = ".$_GET['view']."");
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
  <body id="contact">
    

  <?php include '../includes/layouts/header.php';?>


      <div class=" content container">
           <div class="row">
          <div class="col-md-6">
            <h1><?php echo $shop_name; ?> <small><?php echo $shop_category; ?></small></h1>
          </div>
          <div class="col-md-6">
            <a href="#" class="btn btn-success btn-lg" style="margin-top: 20px;" role="button">Set Schedule Now!</a>
          </div>
        </div>
        
        <div class="row" style="margin-top: 20px;">

          <div class="col-sm-4">
            
            <img src="images/<?php echo $shop_image?>"  style="height: 300px; width: 300px;" class="img-responsive img-circle">
          </div>
          <div class="col-sm-8">
            <h3>Shop description</h3>
            <p><pre><?php echo $shop_description; ?></pre></p>

            <h3>Shop information</h3>
            <p><pre><span class="glyphicon glyphicon-phone-alt"></span> <?php echo $shop_contact; ?></pre></p>
             <p><pre>Business hours: <?php echo $shop_schedule; ?></pre></p>

            <h3>Services Offered</h3>
            <div class="table-responsive" >
              <table class="table ">

                <tr>
                 
                  <th width="20%">Service</th>
                  <th width="20%">Description</th>
                  <th width="20%">Cost</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($service_results)) { ?>
                  <tr class="success">
                     
                      <td > <?php echo $row['service_name']; ?></td>
                      <td > <?php echo $row['service_description'];?></td>
                      <td >P <?php echo $row['service_cost'];?></td>

                  </tr>

                       
                  <?php } ?>
              </table>
            </div> 

          </div>
        </div>

           <div class="row">
          <div class="col-md-12">
            <h3><span class="glyphicon glyphicon-map-marker"></span>Shop Location</h3>
          </div>
        </div>
        
      </div>
  

    <?php include '../includes/layouts/footer.php';?>