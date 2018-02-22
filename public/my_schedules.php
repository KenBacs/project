<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>

<?php
  include_once '../includes/db_connection.php';
  
    $msg = '';
    $msgClass = '';
    $schedule_id = 0;



    if (isset($_GET['cancel'])) {
      $schedule_id = $_GET['cancel'];

      $status = 'Cancelled';
      $query = "UPDATE schedules SET status = '$status' WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection));   
      
    }


   // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND schedules.service_id = services.service_id AND schedules.user_id = ".$_SESSION['u_id']."");

 
  // Total bill
    $total_results =  mysqli_query($connection, "SELECT job_orders.job_order_id as job_order_id, job_orders.quantity as quantity ,services.service_name as service_name,services.service_cost as service_cost, SUM(service_cost * quantity) as total FROM job_orders,services WHERE job_orders.schedule_id = $schedule_id AND services.service_id = job_orders.service_id");

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
  <body id="my_schedules">

  

  <?php include '../includes/layouts/header.php';?>

    
    
    <div class="content container">
      <h1 class="text-center"><span class="glyphicon glyphicon-calendar"></span> My Schedules</h1>
      <div class="row">
        <div class="col-sm-12">
         <?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
          <?php endif;?>
           <div class="table-responsive"  >
              <table class="table">

                <tr>
              
                   <th width="20%">Shop Name</th>
                  <th width="20%">Scheduled Date</th>
                  <th width="20%">Service</th>
                  <th width="20%">Status</th>
                  <th width="20%">Action</th>
                
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['shop_name']; ?></td>
                      <td><?php echo $row['schedule_date']; ?></td>
                      <td><?php echo $row['service_name']; ?></td>
                      <td><?php echo $row['status']; ?></td>
                    

                  <?php if($row['status'] != 'Cancelled' && $row['status'] != 'Accepted' && $row['status'] != 'Declined' && $row['status'] != 'Done' && $row['status'] != 'Ready to Claim' && $row['status'] != 'Claimed'):  ?>
                      <td >
                      <a href="my_schedules.php?cancel=<?php echo $row['schedule_id']; ?>"  class="btn btn-danger" role="button"><span class="glyphicon glyphicon-remove"></span> Cancel Schedule</a>
                      </td>
                  <?php elseif ($row['status'] == 'Done'):  ?>
          
                      <td>
                            <a href="user_bill_summary.php?myshop=<?php echo $row['shop_id'];?>&bill=<?php echo $row['schedule_id'];?>"  class="btn btn-info" role="button">Pay Bill</a>
                      </td>

                  <?php elseif ($row['status'] == 'Ready to Claim' || $row['status'] == 'Claimed' ) :  ?>
          
                      <td>
                            <a href="user_bill_summary.php?myshop=<?php echo $row['shop_id'];?>&bill=<?php echo $row['schedule_id'];?>&view=<?php echo $row['schedule_id'];?>"  class="btn btn-info" role="button"><span class="glyphicon glyphicon-eye-open"></span>  View Invoice</a>
                      </td>

                      
                  <?php endif ?>

                  </tr>


                  
                       
                  <?php } ?>
              </table>
            </div> 

        </div>
      </div>
              
    </div> 



    <?php include '../includes/layouts/footer.php';?>