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
    $grand_total = 0;



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

      if (isset($_POST['submit'])) {

      $quantity = mysql_prep($_POST['quantity']);
      $selectedService = mysql_prep($_POST['selectedService']);

      if (!empty($quantity) && !empty($selectedService)) {

           if ($quantity > 0) {

            $query = "INSERT INTO job_orders (schedule_id, service_id, quantity) VALUES ($schedule_id, $selectedService, $quantity)";
              if (mysqli_query($connection, $query)) {
                  $msg ="Added successfully";
                  $msgClass ="alert-success";
                  $quantity = 0;
                  $selectedService = '';
              } else {
                    $msg ="Failed to add".mysqli_error($connection);
                    $msgClass ="alert-success";
              }
               
        } else {
          $msg = 'Invalid number of items';
          $msgClass = 'alert-danger';
        }
        
      } else {
        $msg = 'Fill all fields';
        $msgClass = 'alert-danger';
      }
    }


      if (isset($_POST['update'])) {

      $quantity = mysql_prep($_POST['quantity']);
      $selectedService = mysql_prep($_POST['selectedService']);
      $job_order_id = mysql_prep($_POST['job_order_id']);

      if (!empty($quantity) && !empty($selectedService)) {

           if ($quantity > 0) {

            $query = "UPDATE job_orders SET quantity = $quantity, service_id = $selectedService WHERE job_order_id = $job_order_id ";
              if (mysqli_query($connection, $query)) {
                  $msg ="Updated successfully";
                  $msgClass ="alert-success";
                  $quantity = 0;
                  $selectedService = '';
              } else {
                    $msg ="Failed to update".mysqli_error($connection);
                    $msgClass ="alert-danger";
              }
               
        } else {
          $msg = 'Invalid number of items';
          $msgClass = 'alert-danger';
        }
        
      } else {
        $msg = 'Fill all fields';
        $msgClass = 'alert-danger';
      }
    }

      if (isset($_GET['edit'])) {
      $job_order_id = $_GET['edit'];
      $edit_state=true;
      $rec = mysqli_query($connection,"SELECT * FROM job_orders WHERE job_order_id = $job_order_id");
      $record = mysqli_fetch_array($rec);
      $job_order_id = $record['job_order_id']; 
      $quantity = $record['quantity'];
      $selectedService = $record['service_id'];
      $job_order_id = $record['job_order_id'];
  
  }

  if (isset($_POST['clear'])) {
    $selectedService = '';
    $quantity = 0;
  }

    if (isset($_GET['del'])) {
    $job_order_id = $_GET['del'];
    mysqli_query($connection,"DELETE FROM job_orders WHERE job_order_id = $job_order_id") or die(mysqli_error($connection)); 
    $msg ="service removed successfully ";
      $msgClass ="alert-success";
       
  }

     if (isset($_GET['done'])) {
      $schedule_id = $_GET['done'];

      $status = 'Done';
      $query = "UPDATE schedules SET status = '$status' WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection)); 
      redirect_to('shop_schedules.php?myshop='.$shop_id);  
      
    }


  // Retrieve job orders of a particular schedule
   $results = mysqli_query($connection, "SELECT job_orders.job_order_id as job_order_id, job_orders.quantity as quantity ,services.service_name as service_name,services.service_cost as service_cost, (service_cost * quantity) as sub_total FROM job_orders,services WHERE job_orders.schedule_id = $schedule_id AND services.service_id = job_orders.service_id");

   //Retrive service of a particular shop
   $service_results = mysqli_query($connection, "SELECT * FROM services WHERE shop_id = $shop_id ");

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
  <body id="billing">
    

  <?php include '../includes/layouts/provider_header.php';?>

   
    <div class="content container">
      <a href="shop_schedules.php?myshop=<?php echo $shop_id?>"  class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-backward"></span> Back to Shop Schedules</a>
     <h1 class="text-center" style="margin-bottom: 20px;"><?php echo $shop_name; ?><small> Billing</small></h1>

    <div class="row">

      <div class="col-md-4">

          <h2 class="text-center bg-info"><span class="glyphicon glyphicon-plus"></span> Add Service Rendered</h2>
       

          <?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
          <?php endif;?>

         
       <form  action="billing.php?myshop=<?php echo $shop_id;?>&bill=<?php echo $schedule_id;?>" method="POST">
                  <input type="hidden" name="job_order_id" value="<?php echo $job_order_id;?>">
                  
                        <div class="form-group">
                            <label for="quantity">Number of items</label> 
                            <input type="number" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
                        </div> 

                             <div class="form-group">
                            <label for="selectedService">Category</label>
                            <select class="form-control" name="selectedService" id="selectedService" >
                            <option value="">Choose Service</option>
                            <?php while ($row = mysqli_fetch_array($service_results)) { ?>

                                 <option value="<?php echo $row['service_id'];?>"><?php echo $row['service_name']; ?></option> 

                            <?php } ?>

                               <script type="text/javascript">
                            document.getElementById('selectedService').value = "<?php echo $selectedService;?>";
                          </script>
                                                   
                            
                          </select>


                          </div>
              

                        
                          <?php if($edit_state == false): ?>
                            <button  type="submit" name="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-plus-sign"> </span> Add Service</button> 
                          <?php else: ?>
                            <button  type="submit" name="update" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-refresh"></span> Update </button> 
                          <?php endif ?>

                          <button  type="submit" name="clear" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-erase"></span> </span> Clear fields</button>

                      </form>
                     
                    
      </div>  

      
        <div class="col-md-8">
            <pre class="text-info">Information:<br/>Username: <?php echo $user_uid; ?><br>Schedule Date: <?php echo $schedule_date;?><br>Schedule time: <?php echo $schedule_time;?></pre>
           <?php $total = mysqli_fetch_array($total_results); 
            $grand_total = $total['total'];
           ?>

           <table>
             <tr>  
                  <th width="20%"><h2>Total cost :  </h2> </th>
                   <th width="30%"><h2 >P <?php if (isset($total['total'])) { echo $total['total'];} else { echo "0.00";} ?></h2></th>
                   <form action="billing.php?myshop=<?php echo $shop_id;?>&bill=<?php echo $schedule_id;?>" method="POST">
                      <input type="hidden" name="grand_total" value="<?php echo $grand_total;?>">
                      <th width="25%" style="padding-right: 10px;">
                       <h1><a href="bill_summary.php?myshop=<?php echo $shop_id; ?>&bill=<?php echo $schedule_id?>" class="btn btn-info btn-lg btn-block" role="button"><span class="glyphicon glyphicon-eye-open"></span> View Bill</a></h1>
                        </th>
                      <th width="25%">
                         <h1><a href="billing.php?myshop=<?php echo $shop_id?>&bill=<?php echo $schedule_id?>&done=<?php echo $schedule_id?>"  class="btn btn-success btn-lg btn-block" role="button"><span class="glyphicon glyphicon-check"></span> Done</a></h1>
                      </th>
                  </form>
              </tr>
           
             
           </table>
    
      
           <div class="clearfix"></div> 
          <div class="table-responsive"  >
              <table class="table">

                <tr>
                  <th width="10%">Quantity</th>
                  <th width="10%">Service</th>
                  <th width="10%">Cost</th>
                  <th width="10%">Sub-total</th>
                  <th width="20%">Action</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['quantity']; ?></td>
                      <td><?php echo $row['service_name']; ?></td>
                      <td>P <?php echo $row['service_cost']; ?></td>
                       <td>P <?php echo $row['sub_total']; ?></td>
                      <td>             
                      <a href="billing.php?myshop=<?php echo $shop_id; ?>&bill=<?php echo $schedule_id?>&edit=<?php echo $row['job_order_id'];?>" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                      <a href="billing.php?myshop=<?php echo $shop_id; ?>&bill=<?php echo $schedule_id?>&del=<?php echo $row['job_order_id'];?>" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-remove"></span> Delete</a>
                      </td>

                  </tr>

                  
                       
                  <?php } ?>
              </table>
            </div> 

              

        </div>
      </div>
                  

              
    </div> 
     


  

    <?php include '../includes/layouts/footer.php';?>