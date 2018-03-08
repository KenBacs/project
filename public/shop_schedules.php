<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
    
    require __DIR__ . '/twilio-php-master/Twilio/autoload.php';
    use Twilio\Rest\Client;

    $sid = 'AC7e9dd4e18f3c03b53abf72d6339c995a';
    $token = '7162e668c2944c38c08da560b6b287a0';

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
    $date_start = '';
    $date_end = '';


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

/*   if (isset($_GET['accept'])) {
      $schedule_id = $_GET['accept'];

      $status = 'Accepted';
      $query = "UPDATE schedules SET status = '$status' WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection)); 

      redirect_to('')  
    }*/


   if (isset($_GET['decline'])) {
      $schedule_id = $_GET['decline'];

      $status = 'Declined';
      $query = "UPDATE schedules SET status = '$status' WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection));   
      
    }

      if (isset($_GET['claim'])) {
      $schedule_id = $_GET['claim'];
      $date = date('Y-m-d H:i:s');

      $status = 'Claimed';
      $query = "UPDATE schedules SET status = '$status', claim_date = '$date', claim_time = NOW() WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection));   
      
    }

    if (isset($_GET['receive'])) {
      $schedule_id = $_GET['receive'];
      $date = date('Y-m-d H:i:s');

      $status = 'Item Received';
      $query = "UPDATE schedules SET status = '$status' WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection));   
      
    }


    if (isset($_GET['notyet'])) {
      $schedule_id = $_GET['notyet'];
      $date = date('Y-m-d H:i:s');

      $status = 'Accepted';
      $query = "UPDATE schedules SET status = '$status' WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection));   
      
    }

    if (isset($_GET['notyetready'])) {
      $schedule_id = $_GET['notyetready'];
      $date = date('Y-m-d H:i:s');

      $status = 'Done Billing';
      $query = "UPDATE schedules SET status = '$status' WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection));   
      
    }

     if (isset($_GET['unclaim'])) {
      $schedule_id = $_GET['unclaim'];


      
      $status = 'Ready to Claim';
  
      $claim_time  = '00:00:00';
      $query = "UPDATE schedules SET status = '$status', claim_date = NULL, claim_time = '$claim_time'  WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection));   
      
    }

    



   $results = mysqli_query($connection,"SELECT * FROM users,schedules, services WHERE schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");

   if (isset($_POST['submit'])) {
        $date_start = $_POST['date_start'];
        $date_end =$_POST['date_end'];
        $selectStatus = $_POST['selectStatus'];
        $service = $_POST['service'];

        $results = mysqli_query($connection,"SELECT * FROM users, schedules, services WHERE schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");

        if (!empty($selectStatus)) {
          $results = mysqli_query($connection,"SELECT * FROM users, schedules, services WHERE schedules.status = '$selectStatus' AND  schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");
        }
        if (!empty($service)) {
          $results = mysqli_query($connection,"SELECT * FROM users, schedules, services WHERE services.service_id = $service AND  schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");
        }
         if (!empty($selectStatus) && !empty($service)) {
          $results = mysqli_query($connection,"SELECT * FROM users, schedules, services WHERE schedules.status = '$selectStatus' AND services.service_id = $service AND  schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");
        }
        if (!empty($date_start) && !empty($date_end)) {
          $results = mysqli_query($connection,"SELECT * FROM users, schedules, services WHERE schedules.schedule_date BETWEEN '$date_start' AND '$date_end' AND  schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");
        } 
        if (!empty($date_start) && !empty($date_end) && !empty($selectStatus)) {

           $results = mysqli_query($connection,"SELECT * FROM users, schedules, services WHERE schedules.schedule_date BETWEEN '$date_start' AND '$date_end' AND schedules.status = '$status'  AND  schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");
        }
          if (!empty($date_start) && !empty($date_end) && !empty($service)) {

           $results = mysqli_query($connection,"SELECT * FROM users, schedules, services WHERE schedules.schedule_date BETWEEN '$date_start' AND '$date_end' AND services.service_id = $service  AND  schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");
        }
           if (!empty($date_start) && !empty($date_end) && !empty($selectStatus) && !empty($service)) {

           $results = mysqli_query($connection,"SELECT * FROM users, schedules, services WHERE schedules.schedule_date BETWEEN '$date_start' AND '$date_end' AND schedules.status = '$selectStatus' AND services.service_id = $service  AND  schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");
        }

   }

    if (isset($_POST['reset'])) {
      $date_start = '';
       $date_end = '';
       $selectStatus = '';
    }


   //Retrieve services

   $service_results = mysqli_query($connection, "SELECT  * FROM services WHERE shop_id = $shop_id GROUP BY service_name");


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
  <body id="shop_schedules">
    

  <?php include '../includes/layouts/provider_header.php';?>


      <div class=" content container">
      <h1 class="text-center"><span class="glyphicon glyphicon-calendar"></span> <?php echo $shop_name;?> <small>Schedules</small> </h1><br/>
           <div class="row">
        <div class="col-sm-12">
          <form action="shop_schedules.php?myshop=<?php echo $shop_id; ?>" class="form-inline" method="POST" >
            <div class="form-group">
               <input type="date" class="form-control" name="date_start" id="date_start" value="<?php echo $date_start;?>">
               <label> <p>to</p> </label>
               <input type="date" class="form-control" name="date_end" id="date_end" value="<?php echo $date_end;?>">

                <select name="selectStatus" id="selectStatus" class="form-control">

                <option value="">Select Status</option>
                <option value="Pending">Pending</option>
                <option value="Accepted">Accepted</option>
                <option value="Declined">Declined</option>
                <option value="Done Billing">Done Billing</option>
                <option value="Ready to Claim">Ready to Claim</option>
                 <option value="Claimed">Claimed</option>

                </select>

                <script type="text/javascript">
                    document.getElementById('selectStatus').value = "<?php echo $selectStatus;?>";
                  </script>

               <select name="service" id="service" class="form-control">

                <option value="">Select Service</option>
                <?php while ($row = mysqli_fetch_array($service_results)) { ?>
                   <option value="<?php echo $row['service_id'];?>"><?php echo $row['service_name'];?></option>
                <?php } ?>
               
              

                </select>

                <script type="text/javascript">
                    document.getElementById('service').value = "<?php echo $service;?>";
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
              
                    <th width="10%"> User</th>
                  <th width="10%">Scheduled Date</th>
                  <th width="10%">Service</th>
                  <th width="10%">Service Details</th>
                  <th width="10%">Declined Message</th>
                  <th width="10%">Status</th>
                  <th width="30%">Action</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                          <td><a href="p_user_provider.php?myshop=<?php echo $shop_id?>&user=<?php echo $row['user_id'];?>"><?php echo $row['user_uid']; ?></a></td>
                      <td><?php echo $row['schedule_date']; ?></td>
                      <td><?php echo $row['service_name']; ?></td>
                      <td><?php echo $row['description']; ?></td>
                      <td><?php echo $row['decline_message']; ?></td>
                      <td><?php echo $row['status']; ?></td>  
                      <td>



                  <?php if($row['status'] != 'Cancelled' && $row['status'] !='Accepted' && $row['status'] != 'Declined'&& $row['status'] != 'Done Billing' && $row['status'] != 'Ready to Claim' && $row['status'] != 'Claimed'  && $row['status'] != 'Paid' && $row['status'] != 'Item Received')  : ?>
                         <a href="send_message.php?myshop=<?php echo $shop_id;?>&accept=<?php echo $row['schedule_id'];?>"  class="btn btn-primary" role="button"><span class="glyphicon glyphicon-ok"></span> Accept</a>

                       <a href="#"  class="btn btn-danger" role="button" title="<strong>Why?</strong>" data-toggle="popover" data-placement="top" data-content='                       

                      <form method="POST" action="send_message.php">

                      <input type="hidden" name="shop_id" value="<?php echo $shop_id;?>">

                      <input type="hidden" name="schedule_id" value="<?php echo $row['schedule_id'];?>">

                      <div class="form-group">

                        <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>

                      </div>
                      <div class="form-group">

                      <button type="submit" name="submit_declined" class = "btn btn-success btn-block"><span class ="glyphicon glyphicon-ok"></span> Confirm</button>

                      </div>
                      </form>' 
                      data-html="true"><span class="glyphicon glyphicon-remove"></span> Decline</a>
                  <?php elseif($row['status'] == 'Accepted') : ?>
                      
                    
                     <a href="shop_schedules.php?myshop=<?php echo $shop_id?>&receive=<?php echo $row['schedule_id']?>"  class="btn btn-primary" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Item receive</a>

                  <?php elseif($row['status'] == 'Item Received') : ?>

                     <a href="billing.php?myshop=<?php echo $shop_id?>&bill=<?php echo $row['schedule_id']?>"  class="btn btn-primary" role="button"><span class="glyphicon glyphicon-plus"></span> Create Bill</a>

                       <a href="shop_schedules.php?myshop=<?php echo $shop_id?>&notyet=<?php echo $row['schedule_id']?>"  class="btn btn-warning" role="button"> Oops! Not yet received!</a>


                  <?php elseif($row['status'] == 'Done Billing') : ?>

                       <?php 
                          $query = mysqli_query($connection, "SELECT * FROM payments WHERE schedule_id = $row[schedule_id]");
                         $query_check = mysqli_num_rows($query);

                         if($query_check < 1) : ?>

                     <a href="billing.php?myshop=<?php echo $shop_id?>&bill=<?php echo $row['schedule_id']?>"  class="btn btn-primary" role="button"><span class="glyphicon glyphicon-refresh"></span> Update Bill</a>
                      <a href="bill_summary.php?myshop=<?php echo $shop_id?>&cash=<?php echo $row['schedule_id']?>"  class="btn btn-primary" role="button"><span class="glyphicon glyphicon-coins"></span> Cash Payment</a>
                      <a href="send_message.php?myshop=<?php echo $shop_id?>&readytoclaim=<?php echo $row['schedule_id']?>"  class="btn btn-success" role="button" style="margin-top: 5px; margin-bottom: 5px;"><span class="glyphicon glyphicon-thumbs-up"></span> Ready to Claim </a>
                       <a href="bill_summary.php?myshop=<?php echo $shop_id?>&view=<?php echo $row['schedule_id']?>"  class="btn btn-info disabled" role="button"><span class="glyphicon glyphicon-eye-open"></span> Not yet paid</a>

                        <?php else: ?>
                             <a href="send_message.php?myshop=<?php echo $shop_id?>&readytoclaim=<?php echo $row['schedule_id']?>"  class="btn btn-success" role="button" style="margin-top: 5px; margin-bottom: 5px;"><span class="glyphicon glyphicon-thumbs-up"></span> Ready to Claim </a>
                                <a href="bill_summary.php?myshop=<?php echo $shop_id?>&view=<?php echo $row['schedule_id']?>"  class="btn btn-info" role="button"><span class="glyphicon glyphicon-eye-open"></span> View Transaction</a>
                        <?php endif ?>  


                  <?php elseif($row['status'] == 'Ready to Claim') : ?>
                    

                    <?php 
                      $query = mysqli_query($connection, "SELECT * FROM payments WHERE schedule_id ='".$row['schedule_id']."'");
                      $paid_results = mysqli_num_rows($query); ?>

                     <?php if($paid_results < 1) : ?>
                      <a href="shop_schedules.php?myshop=<?php echo $shop_id?>&claim=<?php echo $row['schedule_id']?>"  class="btn btn-success disabled" role="button"><span class="glyphicon glyphicon-check"></span> Claim</a>
                     <a href="bill_summary.php?myshop=<?php echo $shop_id?>&view=<?php echo $row['schedule_id']?>"  class="btn btn-info disabled" role="button" ><span class="glyphicon glyphicon-eye-close "></span> Not yet paid</a>
                      <a href="bill_summary.php?myshop=<?php echo $shop_id?>&cash=<?php echo $row['schedule_id']?>"  class="btn btn-primary" role="button"><span class="glyphicon glyphicon-coins"></span> Cash Payment</a>
                      <a href="shop_schedules.php?myshop=<?php echo $shop_id?>&notyetready=<?php echo $row['schedule_id'];?>"  class="btn btn-warning " role="button" style="margin-top: 5px; margin-bottom: 5px;"><span class="glyphicon glyphicon-remove"></span> Not yet ready</a>
                    <?php else: ?>
                       <a href="shop_schedules.php?myshop=<?php echo $shop_id?>&claim=<?php echo $row['schedule_id']?>"  class="btn btn-success" role="button"><span class="glyphicon glyphicon-check"></span> Claim</a>
                     <a href="bill_summary.php?myshop=<?php echo $shop_id?>&view=<?php echo $row['schedule_id']?>"  class="btn btn-info" role="button"><span class="glyphicon glyphicon-eye-open"></span> View Transaction</a>
                      <a href="shop_schedules.php?myshop=<?php echo $shop_id?>&notyetready=<?php echo $row['schedule_id'];?>"  class="btn btn-warning " role="button" style="margin-top: 5px; margin-bottom: 5px;"><span class="glyphicon glyphicon-remove"></span> Not yet ready</a>
                    <?php endif ?>
 

                 
                    
                   <?php elseif($row['status'] == 'Claimed') : ?>

                      <a href="shop_schedules.php?myshop=<?php echo $shop_id?>&unclaim=<?php echo $row['schedule_id']?>"  class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove"></span> Unclaim</a>

                    <a href="bill_summary.php?myshop=<?php echo $shop_id?>&view=<?php echo $row['schedule_id']?>"  class="btn btn-info" role="button"><span class="glyphicon glyphicon-eye-open"></span> View Transaction</a>

                  <?php elseif($row['status'] == 'Paid') : ?>

                      <a href="send_message.php?myshop=<?php echo $shop_id?>&readytoclaim=<?php echo $row['schedule_id']?>"  class="btn btn-success" role="button"><span class="glyphicon glyphicon-thumbs-up"></span> Ready to Claim </a>

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

  <script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>    

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
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#comment').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#comment_form')[0].reset();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>
  

    <?php include '../includes/layouts/footer.php';?>