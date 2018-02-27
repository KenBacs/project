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

    //Quick search variable
       $shop_keywords = '';



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
    $user_uid = $record['user_uid'];
    $user_id = $record['user_id'];
    $schedule_date = $record['schedule_date'];
    $schedule_time = date("g:i a", strtotime($record['schedule_time']));
  }


  if (isset($_GET['view'])) {
    $schedule_id = $_GET['view'];
    $rec = mysqli_query($connection,"SELECT * from payments,schedules WHERE payments.schedule_id = schedules.schedule_id AND payments.schedule_id = $schedule_id ");
    $record = mysqli_fetch_array($rec);
    $schedule_id = $record ['schedule_id'];
    $payment_date = $record['payment_date'];
    $payment_time = date("g:i a", strtotime($record['payment_time']));
 
  }




   

  // Retrieve job orders of a particular schedule
   $results = mysqli_query($connection, "SELECT job_orders.job_order_id as job_order_id, job_orders.quantity as quantity ,services.service_name as service_name,services.service_cost as service_cost, (service_cost * quantity) as sub_total FROM job_orders,services WHERE job_orders.schedule_id = $schedule_id AND services.service_id = job_orders.service_id");

   //Retrive service of a particular shop
   $service_results = mysqli_query($connection, "SELECT * FROM services WHERE shop_id = $shop_id ");

   // Total bill
   $total_results =  mysqli_query($connection, "SELECT job_orders.job_order_id as job_order_id, job_orders.quantity as quantity ,services.service_name as service_name,services.service_cost as service_cost, SUM(service_cost * quantity) as total FROM job_orders,services WHERE job_orders.schedule_id = $schedule_id AND services.service_id = job_orders.service_id");

  $total = mysqli_fetch_array($total_results); 
  $total_amount = $total['total'];

    // Retrieve all shops
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
  </head>
  <body id="bill_summary">
    

  <?php include '../includes/layouts/header.php';?>

   
    <div class="content container">
      <a href="my_schedules.php"  class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-backward"></span> Back to My Schedules</a> 

      <?php if(isset($_GET['view'])):?>
      <h1>Invoice</h1>
    <?php else : ?>
      <h1>Bill Summary</h1>
    <?php endif ?>
      <div class="row">

     
        <div class="col-sm-8">
          <pre >Information:<br/><?php echo $shop_name;?><br/>Username: <?php echo $user_uid; ?><br>Schedule date: <?php echo $schedule_date;?><br>Schedule time: <?php echo $schedule_time;?><?php if(isset($_GET['view'])) : ?><br/>Payment date: <?php echo $payment_date; ?><br/>Payment time: <?php echo $payment_time; ?><?php endif ?>
         

              <div class="table-responsive"  >
              <table>

                <tr >
                  <th width="5%">Quantity</th>
                  <th width="5%">Service</th>
                  <th width="5%">Cost</th>
                  <th width="5%">Sub-total</th>
              
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['quantity']; ?></td>
                      <td><?php echo $row['service_name']; ?></td>
                      <td>P <?php echo $row['service_cost']; ?></td>
                       <td>P <?php echo $row['sub_total']; ?></td>
               
                  </tr>
                 <?php } ?>
                 <tr>
                 
                   <td></td>
                   <td></td>
                   <td><h3>Total cost :  </h3> </td>
                   <td><h3 >P <?php if (isset($total['total'])) { echo $total['total'];} else { echo "0.00";} ?></h3></td>
                 </tr>
              </table>
            </div>        
          </pre>
        </div>

           <div class="col-sm-4">
           <?php if(!isset($_GET['view'])) : ?>    
            <form action="checkout.php" method="POST">
              <input type="hidden" name="schedule_id" value="<?php echo $schedule_id; ?>" >
              <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>" > 

                  
              <button  type="submit" name="checkout" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-money"> </span> Pay Online</button> 

           </form>

          <?php endif ?>
        </div>
       </div> 
            

              
    </div> 
     


  

    <?php include '../includes/layouts/footer.php';?>