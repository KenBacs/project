<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>

<?php
  include_once '../includes/db_connection.php';
  
    $msg = '';
    $msgClass = '';
    $schedule_id = 0;
    $date_start = '';
    $date_end = '';

    
    //Quick search variable
       $shop_keywords = '';



    if (isset($_GET['cancel'])) {
      $schedule_id = $_GET['cancel'];

      $status = 'Cancelled';
      $query = "UPDATE schedules SET status = '$status' WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection));   
      
    }


   // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND schedules.service_id = services.service_id AND schedules.user_id = ".$_SESSION['u_id']."");

 
  // Total bill
    /*$total_results =  mysqli_query($connection, "SELECT job_orders.job_order_id as job_order_id, job_orders.quantity as quantity ,services.service_name as service_name,services.service_cost as service_cost, SUM(service_cost * quantity) as total FROM job_orders,services WHERE job_orders.schedule_id = $schedule_id AND services.service_id = job_orders.service_id");
*/
    if (isset($_POST['submit'])) {

         $date_start = $_POST['date_start'];
         $date_end = $_POST['date_end'];
         $selectStatus = $_POST['selectStatus'];

      // Retrieve records
      $results = mysqli_query($connection, "SELECT * FROM schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND schedules.service_id = services.service_id AND schedules.user_id = ".$_SESSION['u_id']." ORDER BY schedule_date DESC ");

      if (!empty($selectStatus)) {
         // Retrieve records
      $results = mysqli_query($connection, "SELECT * FROM schedules, services, shops WHERE schedules.status = '$selectStatus' AND schedules.shop_id = shops.shop_id AND schedules.service_id = services.service_id AND schedules.user_id = ".$_SESSION['u_id']." ORDER BY schedule_date DESC ") or die(mysqli_error($connection));
      } 
      if (!empty($date_start) && !empty($date_end)) {
           // Retrieve records
      $results = mysqli_query($connection, "SELECT * FROM schedules, services, shops WHERE schedules.schedule_date BETWEEN '$date_start' AND '$date_end' AND schedules.shop_id = shops.shop_id AND schedules.service_id = services.service_id AND schedules.user_id = ".$_SESSION['u_id']." ORDER BY schedule_date DESC ") or die(mysqli_error($connection));
      } 

      if (!empty($date_start) && !empty($date_end) && !empty($selectStatus)) {
         $results = mysqli_query($connection, "SELECT * FROM schedules, services, shops WHERE schedules.schedule_date BETWEEN '$date_start' AND '$date_end' AND schedules.status = '$selectStatus' AND schedules.shop_id = shops.shop_id AND schedules.service_id = services.service_id AND schedules.user_id = ".$_SESSION['u_id']." ORDER BY schedule_date DESC ") or die(mysqli_error($connection));
      }

    }


    if (isset($_POST['reset'])) {
      $date_start = '';
       $date_end = '';
       $selectStatus = '';
    }


 // Retrieve shops for search

  $shops_results = mysqli_query($connection, "SELECT * FROM shops WHERE user_id = ".$_SESSION['u_id']."");

  $shop_all = mysqli_query($connection, "SELECT * FROM shops WHERE shop_status = 1");


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

        <!-- JQuery -->
    <script src="javascripts/jquery-3.2.1.min.js"></script>
  </head>
  <body id="my_schedules">

  

  <?php include '../includes/layouts/header.php';?>

    
    
    <div class="content container">
      <h1 class="text-center"><span class="glyphicon glyphicon-calendar"></span> My Schedules</h1>
      <br/>

      <div class="row">
        <div class="col-sm-12">
          <form action="my_schedules.php" class="form-inline" method="POST" >
            <div class="form-group">
               <input type="date" class="form-control" name="date_start" id="date_start" value="<?php echo $date_start;?>">
               <label> <p>to</p> </label>
               <input type="date" class="form-control" name="date_end" id="date_end" value="<?php echo $date_end;?>">

                <select name="selectStatus" id="selectStatus" class="form-control">

                <option value="">Select Status</option>
                <option value="Pending">Pending</option>
                <option value="Accepted">Accepted</option>
                <option value="Declined">Declined</option>
                <option value="Done">Done</option>
                <option value="Paid">Paid</option>
                <option value="Ready to Claim">Ready to Claim</option>
                 <option value="Claimed">Claimed</option>

                </select>

                <script type="text/javascript">
                    document.getElementById('selectStatus').value = "<?php echo $selectStatus;?>";
                  </script>

               <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <button type="submit" name="reset" class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
            </div>
          
          </form>
        </div>
      </div>
      <br/>

      <div class="row">
        <div class="col-sm-12">
        <div>
          <strong>Results: <?php $shop_count = mysqli_num_rows($results); echo $shop_count;?> </strong> 
        </div>

          <br/>
           <div class="table-responsive"  >
              <table class="table">

                <tr>
              
                   <th width="10%">Shop Name</th>
                  <th width="10%">Scheduled Date</th>
                  <th width="10%">Service</th>
                  <th width="10%">Service Details</th>
                  <th width="10%">Declined Message</th>
                  <th width="10%">Status</th>
                  <th width="15%">Action</th>
                
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['shop_name']; ?></td>
                      <td><?php echo $row['schedule_date']; ?></td>
                      <td><?php echo $row['service_name']; ?></td>                  
                      <td><?php echo $row['description']; ?></td>
                      <td><?php echo $row['decline_message']; ?></td>
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

    
    <script>
$(document).ready(function(){
 
 function load_unseen_notification(view2 = '')
 {
  $.ajax({
   url:"user_fetch.php",
   method:"POST",
   data:{view2:view2,user_id:<?php echo $_SESSION['u_id'];?>},
   dataType:"json",
   success:function(data)
   {
    $('#notify').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 

 
 $(document).on('click', '#notify-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>



 <?php include '../includes/layouts/footer.php';?>