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
    $shop_category = 0;
    $edit_state = false;

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

      if (isset($_GET['claim'])) {
      $schedule_id = $_GET['claim'];

      $status = 'Claimed';
      $query = "UPDATE schedules SET status = '$status' WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection));   
      
    }

     if (isset($_GET['unclaim'])) {
      $schedule_id = $_GET['unclaim'];

      $status = 'Ready to Claim';
      $query = "UPDATE schedules SET status = '$status' WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection));   
      
    }

    



   $results = mysqli_query($connection,"SELECT * FROM users,schedules, services WHERE schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");


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
              
                    <th width="15%"> User</th>
                  <th width="20%">Scheduled Date</th>
                  <th width="20%">Service</th>
                  <th width="20%">Status</th>
                  <th width="25%">Action</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                          <td><a href="p_user_provider.php?myshop=<?php echo $shop_id?>&user=<?php echo $row['user_id'];?>"><?php echo $row['user_uid']; ?></a></td>
                      <td><?php echo $row['schedule_date']; ?></td>
                      <td><?php echo $row['service_name']; ?></td>
                      <td><?php echo $row['status']; ?></td>
                      <td>

                  <?php if($row['status'] != 'Cancelled' && $row['status'] !='Accepted' && $row['status'] != 'Declined'&& $row['status'] != 'Done' && $row['status'] != 'Ready to Claim' && $row['status'] != 'Claimed')  : ?>
                         <a href="shop_schedules.php?myshop=<?php echo $shop_id?>&accept=<?php echo $row['schedule_id']?>"  class="btn btn-primary" role="button"><span class="glyphicon glyphicon-ok"></span> Accept</a>

                       <a href="shop_schedules.php?myshop=<?php echo $shop_id?>&decline=<?php echo $row['schedule_id']?>"  class="btn btn-danger" role="button"><span class="glyphicon glyphicon-remove"></span> Decline</a>
                  <?php elseif($row['status'] == 'Accepted') : ?>
                      
                     <a href="billing.php?myshop=<?php echo $shop_id?>&bill=<?php echo $row['schedule_id']?>"  class="btn btn-primary" role="button"><span class="glyphicon glyphicon-plus"></span> Create Bill</a>

                  <?php elseif($row['status'] == 'Done') : ?>
                     <a href="billing.php?myshop=<?php echo $shop_id?>&bill=<?php echo $row['schedule_id']?>"  class="btn btn-primary" role="button"><span class="glyphicon glyphicon-refresh"></span> Update Bill</a>
                      <a href="bill_summary.php?myshop=<?php echo $shop_id?>&cash=<?php echo $row['schedule_id']?>"  class="btn btn-primary" role="button"><span class="glyphicon glyphicon-coins"></span> Cash Payment</a>
                  <?php elseif($row['status'] == 'Ready to Claim') : ?>
                    <a href="shop_schedules.php?myshop=<?php echo $shop_id?>&claim=<?php echo $row['schedule_id']?>"  class="btn btn-success" role="button"><span class="glyphicon glyphicon-check"></span> Claim</a>


                    <a href="bill_summary.php?myshop=<?php echo $shop_id?>&view=<?php echo $row['schedule_id']?>"  class="btn btn-info" role="button"><span class="glyphicon glyphicon-eye-open"></span> View Transaction</a>
                    
                   <?php elseif($row['status'] == 'Claimed') : ?>

                      <a href="shop_schedules.php?myshop=<?php echo $shop_id?>&unclaim=<?php echo $row['schedule_id']?>"  class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove"></span> Unclaim</a>

                    <a href="bill_summary.php?myshop=<?php echo $shop_id?>&view=<?php echo $row['schedule_id']?>"  class="btn btn-info" role="button"><span class="glyphicon glyphicon-eye-open"></span> View Transaction</a>
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