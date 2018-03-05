<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  
    include_once '../includes/db_connection.php';

    $date_start = '';
    $date_end = '';
    $sub_type = 0;
    $method_type = '';

        // Retrive subcription plan
        $sub_results = mysqli_query($connection, "SELECT * FROM subscription_types") or die(mysqli_error($connection));
        
          // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM subscriptions,subscription_types WHERE subscriptions.sub_type_id = subscription_types.sub_type_id"); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM subscriptions ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];

       $sales_results = mysqli_query($connection,"SELECT SUM(subscription_types.sub_cost) AS total_sales FROM subscriptions,subscription_types WHERE subscriptions.sub_type_id = subscription_types.sub_type_id") or die(mysqli_error($connection));

         $rec = mysqli_fetch_array($sales_results);
         $sales = $rec['total_sales'];


           // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_sub, SUM(subscription_types.sub_cost) as daily_sales, subscriptions.subscribe_date as subscribe_date FROM subscriptions, subscription_types WHERE subscriptions.sub_type_id = subscription_types.sub_type_id GROUP BY subscriptions.subscribe_date");
      


         
            

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["subscribe_date"]."', users:".$row["n_sub"].", sales:".$row["daily_sales"]."}, ";

          
          }




     if (isset($_POST['submit'])) {

            $date_start = $_POST['date_start'];
            $date_end = $_POST['date_end'];
            $sub_type = $_POST['sub_type'];
            $method_type = $_POST['method_type'];
       
              // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM subscriptions,subscription_types WHERE subscriptions.sub_type_id = subscription_types.sub_type_id"); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM subscriptions ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];

        $sales_results = mysqli_query($connection,"SELECT SUM(subscription_types.sub_cost) AS total_sales FROM subscriptions,subscription_types WHERE subscriptions.sub_type_id = subscription_types.sub_type_id") or die(mysqli_error($connection));

         $rec = mysqli_fetch_array($sales_results);
         $sales = $rec['total_sales'];


           // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_sub, SUM(subscription_types.sub_cost) as daily_sales, subscriptions.subscribe_date as subscribe_date FROM subscriptions, subscription_types WHERE subscriptions.sub_type_id = subscription_types.sub_type_id GROUP BY subscriptions.subscribe_date");

      
          

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["subscribe_date"]."', users:".$row["n_sub"].", sales:".$row["daily_sales"]."}, ";
        
        
          }



          if (!empty($sub_type)) {

           // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM subscriptions,subscription_types WHERE subscriptions.sub_type_id = $sub_type AND subscriptions.sub_type_id = subscription_types.sub_type_id"); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM subscriptions WHERE sub_type_id = $sub_type ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];

        $sales_results = mysqli_query($connection,"SELECT SUM(subscription_types.sub_cost) AS total_sales FROM subscriptions,subscription_types WHERE subscriptions.sub_type_id = subscription_types.sub_type_id AND subscriptions.sub_type_id = $sub_type") or die(mysqli_error($connection));

         $rec = mysqli_fetch_array($sales_results);
         $sales = $rec['total_sales'];


           // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_sub, SUM(subscription_types.sub_cost) as daily_sales, subscriptions.subscribe_date as subscribe_date FROM subscriptions, subscription_types WHERE subscriptions.sub_type_id = $sub_type AND subscriptions.sub_type_id = subscription_types.sub_type_id GROUP BY subscriptions.subscribe_date");

      
    

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["subscribe_date"]."', users:".$row["n_sub"].", sales:".$row["daily_sales"]."}, ";
 

        
          }

          
          }

        if (!empty($method_type)) {

           // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM subscriptions,subscription_types WHERE subscriptions.method = '$method_type' AND subscriptions.sub_type_id = subscription_types.sub_type_id"); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM subscriptions WHERE method = '$method_type' ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];

         $sales_results = mysqli_query($connection,"SELECT SUM(subscription_types.sub_cost) AS total_sales FROM subscriptions,subscription_types WHERE subscriptions.sub_type_id = subscription_types.sub_type_id AND subscriptions.method = '$method_type'") or die(mysqli_error($connection));

         $rec = mysqli_fetch_array($sales_results);
         $sales = $rec['total_sales'];


           // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_sub, SUM(subscription_types.sub_cost) as daily_sales, subscriptions.subscribe_date as subscribe_date FROM subscriptions, subscription_types WHERE subscriptions.method = '$method_type' AND subscriptions.sub_type_id = subscription_types.sub_type_id GROUP BY subscriptions.subscribe_date");

      
          

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["subscribe_date"]."', users:".$row["n_sub"].", sales:".$row["daily_sales"]."}, ";
          
        
          }

          
          }

         if (!empty($date_start) && !empty($date_end)) {

        // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM subscriptions,subscription_types WHERE subscriptions.subscribe_date BETWEEN '$date_start' AND '$date_end' AND subscriptions.sub_type_id = subscription_types.sub_type_id"); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM subscriptions WHERE subscribe_date BETWEEN '$date_start' AND '$date_end' ") or die(mysqli_error($connection));

  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];

        $sales_results = mysqli_query($connection,"SELECT SUM(subscription_types.sub_cost) AS total_sales FROM subscriptions,subscription_types WHERE subscriptions.sub_type_id = subscription_types.sub_type_id AND subscriptions.subscribe_date BETWEEN '$date_start' AND '$date_end'") or die(mysqli_error($connection));

         $rec = mysqli_fetch_array($sales_results);
         $sales = $rec['total_sales'];


           // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_sub, SUM(subscription_types.sub_cost) as daily_sales, subscriptions.subscribe_date as subscribe_date FROM subscriptions, subscription_types WHERE subscriptions.subscribe_date BETWEEN '$date_start' AND '$date_end' AND subscriptions.sub_type_id = subscription_types.sub_type_id GROUP BY subscriptions.subscribe_date") or die(mysqli_error($connection));
       
      
          
          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["subscribe_date"]."', users:".$row["n_sub"].", sales:".$row["daily_sales"]."}, ";
    
        
          }


        
         } 

         if (!empty($date_start) && !empty($date_end) && !empty($sub_type)) {
         
        // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM subscriptions,subscription_types WHERE subscriptions.subscribe_date BETWEEN '$date_start' AND '$date_end' AND subscriptions.sub_type_id = $sub_type AND subscriptions.sub_type_id = subscription_types.sub_type_id"); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM subscriptions WHERE subscribe_date BETWEEN '$date_start' AND '$date_end' AND sub_type_id = $sub_type ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];

         $sales_results = mysqli_query($connection,"SELECT SUM(subscription_types.sub_cost) AS total_sales FROM subscriptions,subscription_types WHERE subscriptions.sub_type_id = subscription_types.sub_type_id AND subscriptions.subscribe_date BETWEEN '$date_start' AND '$date_end' AND subscriptions.sub_type_id = $sub_type") or die(mysqli_error($connection));

         $rec = mysqli_fetch_array($sales_results);
         $sales = $rec['total_sales'];

           // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_sub, SUM(subscription_types.sub_cost) as daily_sales, subscriptions.subscribe_date as subscribe_date FROM subscriptions, subscription_types WHERE subscriptions.subscribe_date BETWEEN '$date_start' AND '$date_end' AND subscriptions.sub_type_id = $sub_type AND subscriptions.sub_type_id = subscription_types.sub_type_id GROUP BY subscriptions.subscribe_date");
          
      
          
          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["subscribe_date"]."', users:".$row["n_sub"].", sales:".$row["daily_sales"]."}, ";

        
          }

         }

          if (!empty($date_start) && !empty($date_end) && !empty($method_type)) {
         
        // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM subscriptions,subscription_types WHERE subscriptions.subscribe_date BETWEEN '$date_start' AND '$date_end' AND subscriptions.method = '$method_type' AND subscriptions.sub_type_id = subscription_types.sub_type_id"); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM subscriptions WHERE subscribe_date BETWEEN '$date_start' AND '$date_end' AND method = '$method_type' ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];


           // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_sub, SUM(subscription_types.sub_cost) as daily_sales, subscriptions.subscribe_date as subscribe_date FROM subscriptions, subscription_types WHERE subscriptions.subscribe_date BETWEEN '$date_start' AND '$date_end' AND subscriptions.method = '$method_type' AND subscriptions.sub_type_id = subscription_types.sub_type_id GROUP BY subscriptions.subscribe_date");

           $sales_results = mysqli_query($connection,"SELECT SUM(subscription_types.sub_cost) AS total_sales FROM subscriptions,subscription_types WHERE subscriptions.sub_type_id = subscription_types.sub_type_id AND subscriptions.subscribe_date BETWEEN '$date_start' AND '$date_end' AND subscriptions.method = '$method_type' ") or die(mysqli_error($connection));

         $rec = mysqli_fetch_array($sales_results);
         $sales = $rec['total_sales'];

    
        

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["subscribe_date"]."', users:".$row["n_sub"].", sales:".$row["daily_sales"]."}, ";

       
          }

         }

                if (!empty($sub_type) && !empty($method_type)) {
         
        // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM subscriptions,subscription_types WHERE subscriptions.sub_type_id = $sub_type AND subscriptions.method = '$method_type' AND subscriptions.sub_type_id = subscription_types.sub_type_id"); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM subscriptions WHERE sub_type_id = $sub_type AND method = '$method_type' ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];

          $sales_results = mysqli_query($connection,"SELECT SUM(subscription_types.sub_cost) AS total_sales FROM subscriptions,subscription_types WHERE subscriptions.sub_type_id = subscription_types.sub_type_id AND subscriptions.sub_type_id = $sub_type AND subscriptions.method = '$method_type' ") or die(mysqli_error($connection));

         $rec = mysqli_fetch_array($sales_results);
         $sales = $rec['total_sales'];


           // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_sub, SUM(subscription_types.sub_cost) as daily_sales, subscriptions.subscribe_date as subscribe_date FROM subscriptions, subscription_types WHERE subscriptions.sub_type_id = $sub_type AND subscriptions.method = '$method_type' AND subscriptions.sub_type_id = subscription_types.sub_type_id GROUP BY subscriptions.subscribe_date");

    
        

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["subscribe_date"]."', users:".$row["n_sub"].", sales:".$row["daily_sales"]."}, ";

         
          }

         }

          if (!empty($date_start) && !empty($date_end) && !empty($sub_type) && !empty($method_type)) {
         
        // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM subscriptions,subscription_types WHERE subscriptions.subscribe_date BETWEEN '$date_start' AND '$date_end' AND subscriptions.sub_type_id = $sub_type AND subscriptions.method = '$method_type' AND subscriptions.sub_type_id = subscription_types.sub_type_id"); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM subscriptions WHERE subscribe_date BETWEEN '$date_start' AND '$date_end' AND sub_type_id = $sub_type AND method = '$method_type'") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];

          $sales_results = mysqli_query($connection,"SELECT SUM(subscription_types.sub_cost) AS total_sales FROM subscriptions,subscription_types WHERE subscriptions.sub_type_id = subscription_types.sub_type_id AND subscribe_date BETWEEN '$date_start' AND '$date_end' AND subscriptions.sub_type_id = $sub_type AND subscriptions.method = '$method_type' ") or die(mysqli_error($connection));

         $rec = mysqli_fetch_array($sales_results);
         $sales = $rec['total_sales'];



           // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_sub, SUM(subscription_types.sub_cost) as daily_sales, subscriptions.subscribe_date as subscribe_date FROM subscriptions, subscription_types WHERE subscriptions.subscribe_date BETWEEN '$date_start' AND '$date_end' AND subscriptions.sub_type_id = $sub_type AND subscriptions.method = '$method_type' AND subscriptions.sub_type_id = subscription_types.sub_type_id GROUP BY subscriptions.subscribe_date");
      
          
          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["subscribe_date"]."', users:".$row["n_sub"].", sales:".$row["daily_sales"]."}, ";
          
          }

         }
      


      
      



     }

    if (isset($_POST['reset'])) {
        $date_start = '';
        $date_end = '';
        $sub_type = 0;
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
  <body id="subscription_report">
    

  <?php include '../includes/layouts/admin_header.php';?>


      <div class=" content container">
      
       <h1>Subscription <small>Sales Report</small></h1>
       <blockquote class="text-center">Daily Subscription Sales Chart</blockquote>

         <div class="row">
        <div class="col-sm-12">
        <div class="">
               <div id="chart" style="height: 250px;"></div>
        
        </div>
     
        </div>
      </div>

        <div class="row">
         <form action="subscription_report.php" class="form-inline" method="POST">


         <div class="col-sm-12">

          <div class="form-group">
        
            
            <input type="date" name="date_start" class="form-control" style="margin: 10px;" value="<?php echo $date_start;?>"> 

            <label> <p>to</p> </label>

             <input type="date" name="date_end" class="form-control" style="margin: 10px;" value="<?php echo $date_end;?>">  
             
              <select name="sub_type" id="sub_type" class="form-control" style="margin:10px;">

                <option value="0">Choose subcription plan</option>

                <?php while ($row = mysqli_fetch_array($sub_results)) { ?>

                   <option value="<?php echo $row['sub_type_id'];?>"><?php echo $row['sub_type'];?></option>

                <?php } ?>
               

                </select>

               <script type="text/javascript">
                    document.getElementById('sub_type').value = "<?php echo $sub_type;?>";
                  </script>


                 <select name="method_type" id="method_type" class="form-control" style="margin:10px;">

                <option value="">Choose Payment Type</option>

                   <option value="Cash">Cash</option>
                   <option value="PayPal">PayPal</option>

                </select>

               <script type="text/javascript">
                    document.getElementById('method_type').value = "<?php echo $method_type;?>";
                  </script>
                
                

               <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <button type="submit" name="reset" class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                  
          </div>   
         </div>
        

           </form>
            
        </div>

      

       <div class="row">  
         <div class="col-sm-12">
             
              <h4><strong>Subcriptions: <?php echo $count; ?></strong></h4>
              <h4><strong>Sales: <?php if(isset($sales)){echo $sales;} else {echo "0.00";}  ?></strong></h4>
              <div class="table-responsive">
              <table class="table">

                <tr>
                    
                      <th width="10%"> User ID</th>
                    <th width="10%"> Subcription</th>
                  <th width="10%">Payment Method</th>
                  <th width="10%">Subscribe Date</th>
                  <th width="10%">Subscribe Time</th>
                  
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['user_id']; ?></td>
                      <td><?php echo $row['sub_type']; ?></td>
                      <td><?php echo $row['method']; ?></td>
                      <td><?php echo $row['subscribe_date']; ?></td>
                      <td><?php echo $row['subscribe_time']; ?></td>
        

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

          ykeys: ['users','sales'],

          labels: ['Users','Sales'],

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