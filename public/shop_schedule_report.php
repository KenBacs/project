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
        $results = mysqli_query($connection,"SELECT * FROM users,schedules, services WHERE schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");

        $count_results = mysqli_query($connection,"SELECT COUNT(*) AS count FROM users,schedules, services WHERE schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];

     if (isset($_POST['submit'])) {

            $date_start = $_POST['date_start'];
            $date_end = $_POST['date_end'];
            $status = $_POST['status'];

            if ($status == "") {
                   $results = mysqli_query($connection,"SELECT * FROM users,schedules, services WHERE schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");

                    $count_results = mysqli_query($connection,"SELECT COUNT(*) AS count FROM users,schedules, services WHERE schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];


            } else {
                 
                  
                 $query = "SELECT *  FROM users,schedules, services WHERE schedules.shop_id = $shop_id AND status = '$status' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services WHERE schedules.shop_id = $shop_id AND status = '$status' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY schedule_id DESC");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];


               
            } 


           if (!empty($_POST['date_start']) && !empty($_POST['date_end']) && !empty($_POST['status'])) {

             $query = "SELECT *  FROM users,schedules, services WHERE schedules.shop_id = $shop_id AND status = '$status' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.schedule_date BETWEEN '$date_start' AND '$date_end' ORDER BY schedule_id DESC";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services WHERE schedules.shop_id = $shop_id AND status = '$status' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.schedule_date BETWEEN '$date_start' AND '$date_end'  ORDER BY schedule_id DESC");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

           }

                  if (!empty($_POST['date_start']) && !empty($_POST['date_end'])) {

             $query = "SELECT *  FROM users,schedules, services WHERE schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.schedule_date BETWEEN '$date_start' AND '$date_end' ORDER BY schedule_id DESC";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services WHERE schedules.shop_id = $shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.schedule_date BETWEEN '$date_start' AND '$date_end'  ORDER BY schedule_id DESC");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

           }

      



     }

    if (isset($_POST['reset'])) {
      $date_start = '';
       $date_end = '';
       $status = '';
    }



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
  <body id="shop_schedule_report">
    

  <?php include '../includes/layouts/provider_header.php';?>


      <div class=" content container">
      
       <h1><?php echo $shop_name; ?> <small>Schedule Report</small></h1>


        <div class="row">
         <form action="shop_schedule_report.php?myshop=<?php echo $shop_id;?>" class="form-inline" method="POST">


         <div class="col-sm-8">

          <div class="form-group">
        
            
            <input type="date" name="date_start" class="form-control" style="margin-right: 10px;" value="<?php echo $date_start;?>"> 

            <label> <p>to</p> </label>

             <input type="date" name="date_end" class="form-control" style="margin-right: 10px; margin-left: 10px;" value="<?php echo $date_end;?>">  
             

                
                <select name="status" id="status" class="form-control" style="margin-right: 10px;">

                <option value="">Select Status</option>
                <option value="Pending">Pending</option>
                <option value="Accepted">Accepted</option>
                <option value="Declined">Declined</option>
                <option value="Done">Done</option>
                <option value="Ready to Claim">Ready to Claim</option>
                 <option value="Claimed">Claimed</option>

                </select>

               <script type="text/javascript">
                    document.getElementById('status').value = "<?php echo $status;?>";
                  </script>

               <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <button type="submit" name="reset" class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                  
          </div>   
         </div>
        

           </form>
            
        </div>

       <div class="row">
         <div class="col-sm-12">
             
              <h4><strong>Number of schedules: <?php echo $count; ?></strong></h4>
              <div class="table-responsive">
              <table class="table">

                <tr>
              
                    <th width="15%"> User</th>
                  <th width="20%">Scheduled Date</th>
                  <th width="20%">Service</th>
                  <th width="20%">Status</th>
                  
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                          <td><?php echo $row['user_uid']; ?></td>
                      <td><?php echo $row['schedule_date']; ?></td>
                      <td><?php echo $row['service_name']; ?></td>
                      <td><?php echo $row['status']; ?></td>
                 
                  </tr>


                  
                       
                  <?php } ?>
              </table>
            </div>          
           </div>
       </div>

      </div>
  

    <?php include '../includes/layouts/footer.php';?>