<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  
    include_once '../includes/db_connection.php';
  
   
    $date_start = '';
    $date_end = '';
    $keywords = '';
    $shop_id = 0;
   


        $results = mysqli_query($connection,"SELECT * FROM users, schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY date_sched_created");

        $count_results = mysqli_query($connection,"SELECT COUNT(*) AS count FROM users, schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY date_sched_created ");
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];


            // Retrieve for chart
          $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules  GROUP BY date_sched_created";
          $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {
            $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
          }

     if (isset($_POST['submit'])) {

            $date_start = $_POST['date_start'];
            $date_end = $_POST['date_end'];
            $status = $_POST['status'];
            $service = $_POST['service'];           
           

            $search_results = mysqli_query($connection,"SELECT * FROM shops WHERE shop_name LIKE '%{$keywords}%'") or die(mysqli_error($connection));
            $resultCheck = mysqli_num_rows($search_results);
            $rec = mysqli_fetch_array($search_results);

            if (!$resultCheck < 1) {
               $keywords = $_POST['keywords'];
               $shop_id = $rec['shop_id'];
            }


           
           
        $results = mysqli_query($connection,"SELECT * FROM users, schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY date_sched_created");

        $count_results = mysqli_query($connection,"SELECT COUNT(*) AS count FROM users, schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY date_sched_created ");
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];


            // Retrieve for chart
          $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules  GROUP BY date_sched_created";
          $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {
            $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
          }


             if(!empty($status)) {
                 
                  
                 
                 $query = "SELECT *  FROM users, schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND schedules.status = '$status' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users, schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND schedules.status = '$status' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                  // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE status = '$status' GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }


               
            } 

              if(!empty($service)) {
                 
                  
                 $query = "SELECT *  FROM users, schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND services.service_id = $service AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users, schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND services.service_id = $service AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                  // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE service_id = $service GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }


               
            } 


      

                  if (!empty($date_start) && !empty($date_end)) {

             $query = "SELECT *  FROM users,schedules, services,shops WHERE schedules.shop_id = shops.shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end' ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end'  ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                  // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE date_sched_created BETWEEN '$date_start' AND '$date_end'  GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }

           }

           if (!empty($keywords)) {
                     
                 $query = "SELECT *  FROM users, schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users, schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id  ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                  // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE shop_id = $shop_id GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }
           }

                if (!empty($date_start) && !empty($date_end) && !empty($status)) {

             $query = "SELECT *  FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND status = '$status' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end' ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services, shops WHERE  schedules.shop_id = shops.shop_id AND status = '$status' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end'  ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                   // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE status = '$status' AND date_sched_created BETWEEN '$date_start' AND '$date_end'  GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }

           }

           if (!empty($date_start) && !empty($date_end) && !empty($service)) {

              $query = "SELECT *  FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND services.service_id = $service AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end' ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services, shops WHERE  schedules.shop_id = shops.shop_id AND services.service_id = $service AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end'  ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                   // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE service_id = $service AND date_sched_created BETWEEN '$date_start' AND '$date_end'  GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }


           }

            if (!empty($date_start) && !empty($date_end) && !empty($keywords)) {

             $query = "SELECT *  FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end' ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services, shops WHERE  schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end'  ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                   // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE shop_id = $shop_id AND date_sched_created BETWEEN '$date_start' AND '$date_end'  GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }

           } 

            if (!empty($status) && !empty($keywords)) {

             $query = "SELECT *  FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND status = '$status' ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND status = '$status'  ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                   // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE shop_id = $shop_id AND status = '$status'  GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }

           }


            if (!empty($service) && !empty($keywords)) {

             $query = "SELECT *  FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND services.service_id = $service ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND services.service_id = $service  ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                   // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE shop_id = $shop_id AND service_id = $service  GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }

           }

 

               if (!empty($status) && !empty($service)) {

             $query = "SELECT *  FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND services.service_id = $service AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND status = '$status' ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND services.service_id = $service AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND status = '$status'  ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                   // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE service_id = $service AND status = '$status'  GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }

           }

             if (!empty($date_start) && !empty($date_end) && !empty($status) && !empty($service)) {

                  $query = "SELECT *  FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND services.service_id = $service AND status = '$status' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end' ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services, shops WHERE  schedules.shop_id = shops.shop_id AND services.service_id = $service AND status = '$status' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end'  ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                   // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE service_id = $service AND status = '$status' AND date_sched_created BETWEEN '$date_start' AND '$date_end'  GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }

           }

                if (!empty($date_start) && !empty($date_end) && !empty($status) && !empty($keywords)) {

                  $query = "SELECT *  FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND status = '$status' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end' ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services, shops WHERE  schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND status = '$status' AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end'  ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                   // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE shop_id = $shop_id AND status = '$status' AND date_sched_created BETWEEN '$date_start' AND '$date_end'  GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }

           }

                     if (!empty($date_start) && !empty($date_end) && !empty($service) && !empty($keywords)) {

                  $query = "SELECT *  FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND services.service_id = $service AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end' ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services, shops WHERE  schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND services.service_id = $service AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end'  ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                   // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE shop_id = $shop_id AND service_id = $service AND date_sched_created BETWEEN '$date_start' AND '$date_end'  GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }

           }

               if (!empty($status) && !empty($service) && !empty($keywords)) {

                  $query = "SELECT *  FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND services.service_id = $service AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND status = '$status' ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services, shops WHERE  schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND services.service_id = $service AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND status = '$status'  ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                   // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE shop_id = $shop_id AND service_id = $service AND status = '$status' GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }

           }

                if (!empty($date_start) && !empty($date_end) && !empty($status) && !empty($service) && !empty($keywords)) {

                  $query = "SELECT *  FROM users,schedules, services, shops WHERE schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND services.service_id = $service AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND status = '$status' AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end' ORDER BY date_sched_created";
                 $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                  $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users,schedules, services, shops WHERE  schedules.shop_id = shops.shop_id AND shops.shop_name LIKE '%{$keywords}%' AND services.service_id = $service AND schedules.service_id = services.service_id AND schedules.user_id = users.user_id AND status = '$status' AND schedules.date_sched_created BETWEEN '$date_start' AND '$date_end' ORDER BY date_sched_created");
              
                     $record = mysqli_fetch_array($count_results);
                     $count = $record['count'];

                   // Retrieve for chart
                    $query = "SELECT date_sched_created, COUNT(*) AS user FROM schedules WHERE shop_id = $shop_id AND service_id = $service AND status = '$status' AND date_sched_created BETWEEN '$date_start' AND '$date_end' GROUP BY date_sched_created";
                    $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    $chart_data = '';
                    while ($row = mysqli_fetch_array($chart_results)) {
                      $chart_data .= "{ date:'".$row["date_sched_created"]."', users:".$row["user"]."}, ";
                    }

           }








     }

    if (isset($_POST['reset'])) {
      $date_start = '';
       $date_end = '';
       $status = '';
       $service = '';
    }

//Retrieve service
    $service_results = mysqli_query($connection, "SELECT * FROM services") or die(mysqli_error($connection));

// Retrieve all shops
  $shop_all = mysqli_query($connection, "SELECT * FROM shops ");


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

    <!-- Chart CSS and JS -->
     <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

     <!-- JQUERY -->
    <script src="javascripts/jquery-3.2.1.min.js"></script>
            
           
  </head>
  <body id="schedules_report">
    

  <?php include '../includes/layouts/admin_header.php';?>


      <div class=" content container">
      
       <h1>Schedule<small> Report</small></h1>
      <blockquote class="text-center">Number Of Users Scheduled Daily</blockquote>

      <div class="row">
        <div class="col-sm-12">
        <div class="">
               <div id="chart" style="height: 250px;"></div>

        </div>
     
        </div>
      </div>
        <div class="row">
         <form action="schedules_report.php" class="form-inline" method="POST">


         <div class="col-sm-12">

          <div class="form-group">
        
            
            <input type="date" name="date_start" class="form-control"  value="<?php echo $date_start;?>"> 

            <label> <p>to</p> </label>

             <input type="date" name="date_end" class="form-control"  value="<?php echo $date_end;?>">  
             

                
                <select name="status" id="status" class="form-control" >

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


                <select name="service" id="service" class="form-control" >

                <option value="">Select Service</option>
                <?php while ($row = mysqli_fetch_array($service_results)) { ?>
                      <option value="<?php echo $row['service_id'];?>"><?php echo $row['service_name'];?></option>
                <?php } ?>
              
               

                </select>

                     <script type="text/javascript">
                    document.getElementById('service').value = "<?php echo $service;?>";
                  </script>

            
                <input type="text" name="keywords" class="form-control" placeholder="Enter Shop Name" style="margin:10px;" value="<?php echo $keywords;?>" autocomplete="off" list = "datalist1">
                <datalist id="datalist1">

                  <?php while ($row = mysqli_fetch_array($shop_all)) { ?>
                        <option value="<?php echo $row['shop_name'];?>">
                  <?php } ?>
 
              
                </datalist>


    

               <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <button type="submit" name="reset" class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                  
          </div>   
         </div>
        

           </form>
            
        </div>

       <div class="row">
         <div class="col-sm-12">
             
              <h4><strong>Schedules: <?php echo $count; ?></strong></h4>
              <div class="table-responsive">
              <table class="table">

                <tr>
              
                    <th width="10%"> User</th>
                    <th width="10%"> Shop</th>
                    <th width="10%">Schedule Date</th>
                   <th width="10%">Claim Date</th>       
                  <th width="10%">Service</th>
                  <th width="10%">Status</th>
                  
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['user_uid']; ?></td>
                      <td><?php echo $row['shop_name']; ?></td>
                      <td><?php echo $row['date_sched_created']; ?></td>
                      <td><?php echo $row['claim_date']; ?></td>
                      <td><?php echo $row['service_name']; ?></td>
                      <td><?php echo $row['status']; ?></td>
                 
                  </tr>


                  
                       
                  <?php } ?>
              </table>
            </div>          
           </div>
       </div>

      </div>

      <script>

      $(document).ready(function() {
        areaChart();
   

        $(window).resize(function() {
          window.areaChart.redraw();
        });
      });

      function areaChart(){
        Morris.Area({
          element : 'chart',

          data: [<?php echo $chart_data;?>],

          xkey: 'date',

          ykeys: ['users'],

          labels: ['Users'],

          resize: true,

          redraw: true
          

         });
      }
      </script>

  <!--     <script>
        
        new Morris.Line({
          // ID of the element in which to draw the chart.
          element: 'myfirstchart',
          // Chart data records -- each entry in this array corresponds to a point on
          // the chart.
          data: [
            { year: '2008', value: 20 },
            { year: '2009', value: 10 },
            { year: '2010', value: 5 },
            { year: '2011', value: 5 },
            { year: '2012', value: 20 }
          ],
          // The name of the data record attribute that contains x-values.
          xkey: 'year',
          // A list of names of data record attributes that contain y-values.
          ykeys: ['value'],
          // Labels for the ykeys -- will be displayed when you hover over the
          // chart.
          labels: ['Value']
        });
      </script> -->

      
        <script type="text/javascript">
              $(document).ready(function(){
     
     function load_unseen_notification(view3 = '')
     {
      $.ajax({
       url:"admin_fetch_subscriptions.php",
       method:"POST",
       data:{view3:view3},
       dataType:"json",
       success:function(data)
       {
        $('#notify-admin').html(data.notification);
        if(data.unseen_notification > 0)
        {
         $('.count').html(data.unseen_notification);
        }
       }
      });
     }
     
     load_unseen_notification();
     

     
     $(document).on('click', '#notify-toggle-admin', function(){
      $('.count').html('');
      load_unseen_notification('yes');
     });
     
     setInterval(function(){ 
      load_unseen_notification();; 
     }, 5000);
     
    });


        </script>


  

    <?php include '../includes/layouts/footer.php';?>