<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  
    include_once '../includes/db_connection.php';
    

    $msg = '';
    $msgClass = '';
    $desc = '';
    $service_id = 0;
    $schedule_date = '';
    $schedule_time = '';


    if (isset($_GET['set'])) {
    $shop_id = $_GET['set'];
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

  if (isset($_POST['submit'])) {
    $schedule_date = mysql_prep($_POST['schedule_date']);
    $schedule_time = mysql_prep($_POST['schedule_time']);
    $service_id = mysql_prep($_POST['service']);
    $desc = mysql_prep($_POST['repair_desc']);

    if (!empty($schedule_date) && !empty($service_id) && !empty($schedule_time)) {
      
      $query = "INSERT INTO schedules (user_id, service_id, shop_id, schedule_date, schedule_time, description) VALUES ('".$_SESSION['u_id']."', $service_id, $shop_id, '$schedule_date','$schedule_time', '$desc')";

      if (mysqli_query($connection,$query)) {
        $msg = 'Schedule request sent succesfully';
         $msgClass = 'alert-success';
      } else {
          $msg = 'schedule failed'.mysqli_error($connection);
         $msgClass = 'alert-success';
      }
      

    } else {
         $msg = 'Fill all fields';
         $msgClass = 'alert-danger';
    }
    
  }

  // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM services WHERE shop_id = $shop_id");



?>

<!doctype html>
<html lang="en">
  <head>
    <title>Fixpertr</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="javascripts/jquery-3.2.1.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/mystyles.css">
  </head>
  <body id="set_schedule">
    

  <?php include '../includes/layouts/header.php';?>


      <div class=" content container">
         
          <div class="row">

          <div class="col-sm-4 col-sm-offset-4">
               <h1><?php echo $shop_name; ?> <small>Set Schedule</small></h1> 
          </div>
            
          </div>

          <div class="row">


          <div class="col-sm-4 col-sm-offset-4">

                <?php if($msg !=''): ?>
                  <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
                 <?php endif; ?>

              <form action="set_schedule.php?set=<?php echo $shop_id;?>" method="POST">
              <div class="form-group">

                <label for="schedule_date">Date schedule</label>
                <input type="date" class="form-control" name="schedule_date" id="schedule_date" value="<?php echo $schedule_date; ?>">
              </div>

              <div class="form-group">
                
                <label for="schedule_time">Time schedule</label>
                <input type="time" class="form-control" name="schedule_time" id="schedule_time" value="<?php echo $schedule_time; ?>">
              </div>

              <div class="form-group">
              <label for="service">Service you want to render</label>
           

              <select class="form-control" name="service" id="service">

              <option value= 0>Choose service</option>
               
              <?php while ($row = mysqli_fetch_array($results)) { ?>
       
              <option value="<?php echo $row['service_id']?>" ><?php echo $row['service_name'];?></option>

             <?php }?>

            </select>

             <script type="text/javascript">
              document.getElementById('service').value = "<?php echo $service_id;?>";
            </script> 
            </div>


              <div class="form-group">
                  <label for="repair_desc">Service details (Optional)</label>
                   <textarea class="form-control" rows="5" id="repair_desc" name="repair_desc" ><?php echo $desc;?></textarea>
                  
              </div> 

       
             
              <button type="submit" name="submit" class="btn btn-success btn-block">Set schedule</button>
            </form>
          </div>
            
          </div>
        
      </div>
  

    <?php include '../includes/layouts/footer.php';?>