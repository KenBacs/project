<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  
    include_once '../includes/db_connection.php';

    $date_start = '';
    $date_end = '';
    $user_type = '';

  
          // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM users"); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];


               // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_users, date_registered FROM users GROUP BY date_registered");
       

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["date_registered"]."', users:".$row["n_users"]."}, ";
          }


     if (isset($_POST['submit'])) {

            $date_start = $_POST['date_start'];
            $date_end = $_POST['date_end'];
            $user_type = $_POST['user_type'];
       
                // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM users"); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];


               // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_users, date_registered FROM users GROUP BY date_registered");
       

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["date_registered"]."', users:".$row["n_users"]."}, ";
          }

          if (!empty($user_type)) {

                    // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM users WHERE user_type = '$user_type' "); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users WHERE user_type = '$user_type' ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];


               // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_users, date_registered FROM users WHERE user_type = '$user_type' GROUP BY date_registered");
       

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["date_registered"]."', users:".$row["n_users"]."}, ";
          }
          
          }

         if (!empty($date_start) && !empty($date_end)) {

       // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM users WHERE date_registered BETWEEN '$date_start' AND '$date_end' "); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users WHERE date_registered BETWEEN '$date_start' AND '$date_end' ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];


               // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_users, date_registered FROM users WHERE date_registered BETWEEN '$date_start' AND '$date_end' GROUP BY date_registered");

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {
            $chart_data .= "{ date:'".$row["date_registered"]."', users:".$row["n_users"]."}, ";
          }
        
         } 

         if (!empty($date_start) && !empty($date_end) && !empty($user_type)) {
           // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM users WHERE user_type = '$user_type' AND date_registered BETWEEN '$date_start' AND '$date_end' "); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM users WHERE user_type = '$user_type' AND date_registered BETWEEN '$date_start' AND '$date_end' ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];


               // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_users, date_registered FROM users WHERE user_type = '$user_type' AND date_registered BETWEEN '$date_start' AND '$date_end' GROUP BY date_registered");

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {
            $chart_data .= "{ date:'".$row["date_registered"]."', users:".$row["n_users"]."}, ";
          }
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

     <!-- Chart CSS and JS -->
     <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

              <!-- JQuery -->
    <script src="javascripts/jquery-3.2.1.min.js"></script>
  </head>
  <body id="user_report">
    

  <?php include '../includes/layouts/admin_header.php';?>


      <div class=" content container">
      
       <h1>User<small> Report</small></h1>
       <blockquote class="text-center">User Registered Chart</blockquote>

         <div class="row">
        <div class="col-sm-12">
        <div class="">
               <div id="chart" style="height: 250px;"></div>
        
        </div>
     
        </div>
      </div>

        <div class="row">
         <form action="user_report.php" class="form-inline" method="POST">


         <div class="col-sm-8">

          <div class="form-group">
        
            
            <input type="date" name="date_start" class="form-control" style="margin: 10px;" value="<?php echo $date_start;?>"> 

            <label> <p>to</p> </label>

             <input type="date" name="date_end" class="form-control" style="margin: 10px;" value="<?php echo $date_end;?>">  
             
              <select name="user_type" id="user_type" class="form-control" style="margin:10px;">

                <option value="">Select User Type</option>
                <option value="User">User</option>
                <option value="Service Provider">Service Provider</option>

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
             
              <h4><strong>Admins: <?php echo $count; ?></strong></h4>
              <div class="table-responsive">
              <table class="table">

                <tr>
                    
                      <th width="10%"> User ID</th>
                    <th width="10%"> First Name</th>
                  <th width="10%">Last Name</th>
                  <th width="10%">Username</th>
                   <th width="10%">User Type</th>
                  <th width="10%">Date Registered</th>
                  
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['user_id']; ?></td>
                      <td><?php echo $row['user_first']; ?></td>
                      <td><?php echo $row['user_last']; ?></td>
                      <td><?php echo $row['user_uid']; ?></td>
                      <td><?php echo $row['user_type']; ?></td>
                      <td><?php echo $row['date_registered']; ?></td>

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

          labels: ['User Registered'],

          resize: true,

          redraw: true
          

         });
      }
      </script>


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