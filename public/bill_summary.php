<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  
    include_once '../includes/db_connection.php';
  
    $msg = '';
    $msgClass = '';
    $schedule_id = 0; 
    $user_id = 0;
    $user_uid = '';
    $schedule_date = '';
    $schedule_time = '';
    $quantity = 0;
    $selectedService = 0;
    $job_order_id = 0;
    $edit_state = false;
    $total_amount = 0;
    $change = 0;
    $cash_given = 0;



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

  if (isset($_GET['bill'])) {
    $schedule_id = $_GET['bill'];
    $rec = mysqli_query($connection,"SELECT * from schedules, users WHERE schedules.user_id = users.user_id AND schedules.schedule_id = $schedule_id ");
    $record = mysqli_fetch_array($rec);
    $schedule_id = $record ['schedule_id'];
    $schedule_status = $record ['status'];
    $user_uid = $record['user_uid'];
    $user_id = $record['user_id'];
    $schedule_date = $record['schedule_date'];
    $schedule_time = date("g:i a", strtotime($record['schedule_time']));
    $total_amount = 0.00;


      // Retrieve job orders of a particular schedule
   $results = mysqli_query($connection, "SELECT job_orders.job_order_id as job_order_id, job_orders.quantity as quantity ,services.service_name as service_name,services.service_cost as service_cost, (service_cost * quantity) as sub_total FROM job_orders,services WHERE job_orders.schedule_id = $schedule_id AND services.service_id = job_orders.service_id") or die(mysqli_error($connection));


   // Total bill
   $total_results =  mysqli_query($connection, "SELECT job_orders.job_order_id as job_order_id, job_orders.quantity as quantity ,services.service_name as service_name,services.service_cost as service_cost, SUM(service_cost * quantity) as total FROM job_orders,services WHERE job_orders.schedule_id = $schedule_id AND services.service_id = job_orders.service_id") or die(mysqli_error($connection));


    $total = mysqli_fetch_array($total_results); 
    $total_amount = $total['total'];
  }

    if (isset($_GET['cash'])) {

    $schedule_id = $_GET['cash'];
    $rec = mysqli_query($connection,"SELECT * from schedules, users WHERE schedules.user_id = users.user_id AND schedules.schedule_id = $schedule_id ");
    $record = mysqli_fetch_array($rec);
    $schedule_id = $record ['schedule_id'];
    $schedule_status = $record ['status'];
    $user_uid = $record['user_uid'];
    $user_id = $record['user_id'];
    $schedule_date = $record['schedule_date'];
    $schedule_time = date("g:i a", strtotime($record['schedule_time']));
    $total_amount = 0.00;

      // Retrieve job orders of a particular schedule
   $results = mysqli_query($connection, "SELECT job_orders.job_order_id as job_order_id, job_orders.quantity as quantity ,services.service_name as service_name,services.service_cost as service_cost, (service_cost * quantity) as sub_total FROM job_orders,services WHERE job_orders.schedule_id = $schedule_id AND services.service_id = job_orders.service_id") or die(mysqli_error($connection));


   // Total bill
   $total_results =  mysqli_query($connection, "SELECT job_orders.job_order_id as job_order_id, job_orders.quantity as quantity ,services.service_name as service_name,services.service_cost as service_cost, SUM(service_cost * quantity) as total FROM job_orders,services WHERE job_orders.schedule_id = $schedule_id AND services.service_id = job_orders.service_id") or die(mysqli_error($connection));


    $total = mysqli_fetch_array($total_results); 
    $total_amount = $total['total'];

  }



  if (isset($_GET['view'])) {
    $schedule_id = $_GET['view'];
    $rec = mysqli_query($connection,"SELECT * from schedules, users , payments WHERE schedules.user_id = users.user_id AND schedules.schedule_id = payments.schedule_id AND schedules.schedule_id = $schedule_id ");
    $record = mysqli_fetch_array($rec);
    $schedule_id = $record ['schedule_id'];
    $user_uid = $record['user_uid'];
    $user_id = $record['user_id'];
    $schedule_date = $record['schedule_date'];
    $schedule_time = date("g:i a", strtotime($record['schedule_time']));
    $payment_date = $record['payment_date'];
    $payment_time = date("g:i a", strtotime($record['payment_time']));
    $payment_method = $record['method'];
    $payment_cash_given = $record['cash_given'];
    $payment_change = $record['amount_change'];
    $total_amount = 0.00;

      // Retrieve job orders of a particular schedule
   $results = mysqli_query($connection, "SELECT job_orders.job_order_id as job_order_id, job_orders.quantity as quantity ,services.service_name as service_name,services.service_cost as service_cost, (service_cost * quantity) as sub_total FROM job_orders,services WHERE job_orders.schedule_id = $schedule_id AND services.service_id = job_orders.service_id") or die(mysqli_error($connection));


   // Total bill
   $total_results =  mysqli_query($connection, "SELECT job_orders.job_order_id as job_order_id, job_orders.quantity as quantity ,services.service_name as service_name,services.service_cost as service_cost, SUM(service_cost * quantity) as total FROM job_orders,services WHERE job_orders.schedule_id = $schedule_id AND services.service_id = job_orders.service_id") or die(mysqli_error($connection));


    $total = mysqli_fetch_array($total_results); 
    $total_amount = $total['total'];

  }

  if (isset($_POST['submit'])) {
    $cash_given = mysql_prep($_POST['cash_given']);
    $amount_due = mysql_prep($_POST['total_amount']);
    $change = $cash_given - $amount_due;
    $method = 'Cash';
    $date = date('Y-m-d H:i:s');
    if ($schedule_status == 'Done Billing') {
       $status = 'Done Billing';
    } else {
       $status = 'Ready to Claim';
    }
   

    if (!empty($cash_given)) {
      if ($cash_given > 0) {
        if ($cash_given >= $amount_due) {


 
    $query = "UPDATE schedules SET status = '$status',payment_status = 1 WHERE schedule_id = $schedule_id ";
    mysqli_query($connection, $query) or die(mysqli_error($connection)); 
          
   $query = "INSERT INTO payments (schedule_id, cash_given, amount_paid, amount_change, method, payment_date, payment_time) VALUES ($schedule_id, $cash_given, $amount_due, $change,'$method', '$date', NOW() )";
   mysqli_query($connection, $query) or die(mysqli_error($connection)); 
  
          $msg = 'Payment made. Thanks!';
          $msgClass = 'alert-success';


        } else {
          $msg = 'Insufficient cash given';
          $msgClass = 'alert-danger';
        }
      } else {
          $msg = 'Invalid cash given';
          $msgClass = 'alert-danger';
      }
    } else {
      $msg = 'Cash given is empty';
      $msgClass = 'alert-danger';
    }

  }

  if (isset($_POST['clear'])) {
    $cash_given = 0;
    $change = 0;
  }




   


   //Retrive service of a particular shop
   $service_results = mysqli_query($connection, "SELECT * FROM services WHERE shop_id = $shop_id ") or die(mysqli_error($connection));



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
  <body id="bill_summary">
    

  <?php include '../includes/layouts/provider_header.php';?>

   <?php if(isset($_GET['cash'])) : ?>
    <div class="content container">



      <div class="row">
        <div class="col-sm-4">

           <a href="shop_schedules.php?myshop=<?php echo $shop_id?>"  class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-backward"></span> Back to Client Schedules</a>        
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-4">
           <h3>Bill Summary</h3>
        </div>
      </div>
     <div class="row">
      <div class="col-sm-4">
      
          <?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
          <?php endif;?>
          
           <form action="bill_summary.php?myshop=<?php echo $shop_id;?>&cash=<?php echo $schedule_id;?>" method="POST">
              <input type="hidden" name="schedule_id" value="<?php echo $schedule_id; ?>" >
           
                       
                        <div class="form-group">
                         <label for="cash_given">Cash Given</label>
                          <div class="input-group">
                                <span class="input-group-addon">P</span>        
                            <input type="number" class="form-control" name="cash_given" value="<?php echo $cash_given;?>">
                          </div>
                   
                        </div> 

                         <div class="form-group">
                            <label for="total_amount">Total Amount Due</label>
                              <div class="input-group"> 
                                <span class="input-group-addon">P</span>        
                            <input type="number" class="form-control " name="total_amount" value="<?php echo $total_amount; ?>" readonly >

                          </div>
                   
                        </div>

                          <div class="form-group">
                            <label for="change">Change</label>
                              <div class="input-group"> 
                                <span class="input-group-addon">P</span>        
                            <input type="number" class="form-control " name="change" value="<?php echo $change;?>" readonly>
                          </div>
                   
                        </div>
                               
                        
                  
              <button  type="submit" name="submit" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-money"> </span> Pay Cash</button> 
              <button  type="submit" name="clear" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-erase"> </span> Clear fields</button> 

           </form>
      </div>

      <div class="col-sm-8">
          <div class="bg-info" style="padding: 5px;">
            <h3>Information</h3>
            <p>Schedule id: <?php echo $schedule_id;?></p>
            <p>Username: <?php echo $user_uid;?></p>
            <p>Schedule date: <?php echo $schedule_date;?></p>
            <p>Schedule time: <?php echo $schedule_time;?></p>

            <div class="table-responsive">
             <table>
                <tr >
                  <th width="10%">Quantity</th>
                  <th width="10%">Service</th>
                  <th width="10%">Cost</th>
                  <th width="10%">Sub-total</th>
              
                </tr> 

             

                <?php while($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['quantity']; ?></td>
                      <td><?php echo $row['service_name']; ?></td>
                      <td>P <?php echo $row['service_cost']; ?></td>
                       <td>P <?php echo $row['sub_total']; ?></td>
               
                  </tr>
                <?php }?>
                <tr>
                  <td colspan="2"></td>
                  <td><h3>Total Cost:</h3></td>
                  <td><h3>P <?php echo $total_amount;?></h3></td>
                </tr>
            </table>
            </div>
         
          </div>
      </div>
    </div>
    </div>
   <?php endif ?> 

    <?php if(isset($_GET['bill'])) : ?>


    <div class="content container">
      <a href="billing.php?myshop=<?php echo $shop_id?>&bill=<?php echo $schedule_id; ?>"  class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-backward"></span> Back to Billing</a>
      <h3>Bill Summary</h3>
      <div class="row">
        <div class="col-sm-8">
           <div class="bg-info" style="padding: 5px;">
            <h3>Information</h3>
            <p>Schedule id: <?php echo $schedule_id;?></p>
            <p>Username: <?php echo $user_uid;?></p>
            <p>Schedule date: <?php echo $schedule_date;?></p>
            <p>Schedule time: <?php echo $schedule_time;?></p>

            <div class="table-responsive">
             <table>
                <tr >
                  <th width="10%">Quantity</th>
                  <th width="10%">Service</th>
                  <th width="10%">Cost</th>
                  <th width="10%">Sub-total</th>
              
                </tr> 

             

                <?php while($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['quantity']; ?></td>
                      <td><?php echo $row['service_name']; ?></td>
                      <td>P <?php echo $row['service_cost']; ?></td>
                       <td>P <?php echo $row['sub_total']; ?></td>
               
                  </tr>
                <?php }?>
              
                <tr>
                  <td colspan="2"></td>
                  <td><h3>Total Cost:</h3></td>
                  <td><h3>P <?php echo $total_amount;?></h3></td>
                </tr>

               
            </table>
            </div>
         
          </div>
        </div>
      </div>
    </div>
   <?php endif ?> 

    <?php if(isset($_GET['view'])) : ?>
    <div class="content container">
      <a href="shop_schedules.php?myshop=<?php echo $shop_id?>"  class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-backward"></span> Back to Client Schedules</a>
      <h1>Transaction</h1>
      <div class="row">
        <div class="col-sm-8">
           <div class="bg-info" style="padding: 5px;">
            <h3>Information</h3>
            <p>Schedule id: <?php echo $schedule_id;?></p>
            <p>Username: <?php echo $user_uid;?></p>
            <p>Schedule date: <?php echo $schedule_date;?></p>
            <p>Schedule time: <?php echo $schedule_time;?></p>
            <p>Payment date: <?php echo $payment_date;?></p>
            <p>Payment time: <?php echo $payment_time;?></p>
            <p>Payment method: <?php echo $payment_method;?></p>
    

            <div class="table-responsive">
             <table>
                <tr >
                  <th width="10%">Quantity</th>
                  <th width="10%">Service</th>
                  <th width="10%">Cost</th>
                  <th width="10%">Sub-total</th>
              
                </tr> 

             

                <?php while($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['quantity']; ?></td>
                      <td><?php echo $row['service_name']; ?></td>
                      <td>P <?php echo $row['service_cost']; ?></td>
                       <td>P <?php echo $row['sub_total']; ?></td>
               
                  </tr>
                <?php }?>
                  <tr>
                  <td colspan="2"></td>
                  <td><h3>Amount Due:</h3></td>
                  <td><h3>P <?php echo $total_amount;?></h3></td>
                </tr>

                   <tr>
                  <td colspan="2"></td>
                  <td><h3>Cash Given:</h3></td>
                  <td><h3>P <?php echo $payment_cash_given;?></h3></td>
                </tr>
              
                 <tr>
                  <td colspan="2"></td>
                  <td><h3>Change:</h3></td>
                  <td><h3>P <?php echo $payment_change;?></h3></td>
                </tr>

            </table>
            </div>
         
          </div>
        </div>
      </div>
    </div>
   <?php endif ?> 

    
    <script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{view:view,shop_id:<?php echo $shop_id;?>},
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
     
      

              
    </div> 
     


  

    <?php include '../includes/layouts/footer.php';?>