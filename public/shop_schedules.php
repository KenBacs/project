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
    $rec = mysqli_query($connection,"SELECT * FROM shops WHERE shop_id = $shop_id");
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

   if (isset($_GET['accept'])) {
      $schedule_id = $_GET['accept'];

      $status = 'Accepted';
      $query = "UPDATE schedules SET status = '$status' WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection));   
      
    }


   if (isset($_GET['decline'])) {
      $schedule_id = $_GET['decline'];

      $status = 'Declined';
      $query = "UPDATE schedules SET status = '$status' WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection));   
      
    }


   $results = mysqli_query($connection,"SELECT * FROM schedules, services WHERE schedules.shop_id = $shop_id AND schedules.service_id = services.service_id");
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
  <body id="shop_schedules">
    

  <?php include '../includes/layouts/provider_header.php';?>


      <div class=" content container">
      <h1 class="text-center"><span class="glyphicon glyphicon-calendar"></span> Schedules</h1>
       <div class="row">
           <div class="col-sm-12">
                <div class="table-responsive"  >
              <table class="table">

                <tr>
              
                    <th width="20%"> User ID</th>
                  <th width="20%">Scheduled Date</th>
                  <th width="20%">Service</th>
                  <th width="20%">Status</th>
                  <th width="20%">Action</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                          <td><?php echo $row['user_id']; ?></td>
                      <td><?php echo $row['schedule_date']; ?></td>
                      <td><?php echo $row['service_name']; ?></td>
                      <td><?php echo $row['status']; ?></td>
                      <td>

                  <?php if($row['status'] != 'Cancelled' && $row['status'] !='Accepted' && $row['status'] != 'Declined')  : ?>
                         <a href="shop_schedules.php?myshop=<?php echo $shop_id?>&accept=<?php echo $row['schedule_id']?>"  class="btn btn-success" role="button"><span class="glyphicon glyphicon-ok"></span> Accept</a>

                       <a href="shop_schedules.php?myshop=<?php echo $shop_id?>&decline=<?php echo $row['schedule_id']?>"  class="btn btn-danger" role="button"><span class="glyphicon glyphicon-remove"></span> Decline</a>
                     
                  <?php endif ?>
                        </td>
                  </tr>


                  
                       
                  <?php } ?>
              </table>
            </div> 

           </div>
       </div>

      </div>
  

    <?php include '../includes/layouts/footer.php';?>