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
         $results = mysqli_query($connection,"SELECT * FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  ORDER BY payments.payment_date") or die(mysqli_error($connection));

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];

        $total_results = mysqli_query($connection,"SELECT SUM(payments.amount_paid) as total FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id ") or die(mysqli_error($connection));

          $record2 = mysqli_fetch_array($total_results);
          $total_sales = $record2['total'];

               // Retrieve for chart
          $query = "SELECT payments.payment_date as payment_date, SUM(payments.amount_paid) AS daily_sales, COUNT(*) as count FROM payments,schedules WHERE schedules.shop_id = $shop_id AND schedules.schedule_id = payments.schedule_id GROUP BY payment_date";
          $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {
            $chart_data .= "{ date:'".$row["payment_date"]."', count:".$row["count"].", daily_sales:".$row["daily_sales"]."}, ";
          }



     if (isset($_POST['submit'])) {

            $date_start = $_POST['date_start'];
            $date_end = $_POST['date_end'];
            $method_type = $_POST['method_type'];
       
       $results = mysqli_query($connection,"SELECT * FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  ORDER BY payments.payment_date") or die(mysqli_error($connection));

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];

        $total_results = mysqli_query($connection,"SELECT SUM(payments.amount_paid) as total FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id ") or die(mysqli_error($connection));

          $record2 = mysqli_fetch_array($total_results);
          $total_sales = $record2['total'];

               // Retrieve for chart
          $query = "SELECT payments.payment_date as payment_date, SUM(payments.amount_paid) AS daily_sales, COUNT(*) as count FROM payments,schedules WHERE schedules.shop_id = $shop_id AND schedules.schedule_id = payments.schedule_id GROUP BY payment_date";
          $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {
            $chart_data .= "{ date:'".$row["payment_date"]."', count:".$row["count"].", daily_sales:".$row["daily_sales"]."}, ";
          }




  if (!empty($method_type)) {



             $results = mysqli_query($connection,"SELECT * FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND payments.method = '$method_type' AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  ORDER BY payments.payment_date") or die(mysqli_error($connection));

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND payments.method = '$method_type' AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];

        $total_results = mysqli_query($connection,"SELECT SUM(payments.amount_paid) as total FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND payments.method = '$method_type' AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id ") or die(mysqli_error($connection));

          $record2 = mysqli_fetch_array($total_results);
          $total_sales = $record2['total'];

               // Retrieve for chart
          $query = "SELECT payments.payment_date as payment_date, SUM(payments.amount_paid) AS daily_sales, COUNT(*) AS count FROM payments,schedules WHERE schedules.shop_id = $shop_id AND payments.method = '$method_type' AND schedules.schedule_id = payments.schedule_id GROUP BY payment_date";
          $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {
           $chart_data .= "{ date:'".$row["payment_date"]."', count:".$row["count"].", daily_sales:".$row["daily_sales"]."}, ";
          }
  }

  if (!empty($date_start) && !empty($date_end)) {
    
             $results = mysqli_query($connection,"SELECT * FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND payments.payment_date BETWEEN '$date_start' AND '$date_end' AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  ORDER BY payments.payment_date") or die(mysqli_error($connection));

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND payments.payment_date BETWEEN '$date_start' AND '$date_end' AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];

        $total_results = mysqli_query($connection,"SELECT SUM(payments.amount_paid) as total FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND payments.payment_date BETWEEN '$date_start' AND '$date_end' AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id ") or die(mysqli_error($connection));

          $record2 = mysqli_fetch_array($total_results);
          $total_sales = $record2['total'];

               // Retrieve for chart
          $query = "SELECT payments.payment_date as payment_date, SUM(payments.amount_paid) AS daily_sales, COUNT(*) AS count FROM payments,schedules WHERE schedules.shop_id = $shop_id AND payments.payment_date BETWEEN '$date_start' AND '$date_end' AND schedules.schedule_id = payments.schedule_id GROUP BY payment_date";
          $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {
           $chart_data .= "{ date:'".$row["payment_date"]."', count:".$row["count"].", daily_sales:".$row["daily_sales"]."}, ";
          }
  }

  if (!empty($date_start) && !empty($date_end) && !empty($method_type)) {
         $results = mysqli_query($connection,"SELECT * FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND payments.payment_date BETWEEN '$date_start' AND '$date_end' AND payments.method = '$method_type' AND '$date_end' AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  ORDER BY payments.payment_date") or die(mysqli_error($connection));

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND payments.payment_date BETWEEN '$date_start' AND '$date_end' AND payments.method = '$method_type' AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];

        $total_results = mysqli_query($connection,"SELECT SUM(payments.amount_paid) as total FROM payments,schedules,users WHERE schedules.shop_id = $shop_id AND payments.payment_date BETWEEN '$date_start' AND '$date_end' AND payments.method = '$method_type' AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id  AND users.user_id = schedules.user_id AND payments.schedule_id = schedules.schedule_id ") or die(mysqli_error($connection));

          $record2 = mysqli_fetch_array($total_results);
          $total_sales = $record2['total'];

               // Retrieve for chart
          $query = "SELECT payments.payment_date as payment_date, SUM(payments.amount_paid) AS daily_sales, COUNT(*) AS count FROM payments,schedules WHERE schedules.shop_id = $shop_id AND payments.payment_date BETWEEN '$date_start' AND '$date_end' AND payments.method = '$method_type' AND schedules.schedule_id = payments.schedule_id GROUP BY payment_date";
          $chart_results = mysqli_query($connection, $query) or die(mysqli_error($connection));

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {
           $chart_data .= "{ date:'".$row["payment_date"]."', count:".$row["count"].", daily_sales:".$row["daily_sales"]."}, ";
          }
  }




     }

    if (isset($_POST['reset'])) {
      $date_start = '';
       $date_end = '';
       $method_type = '';
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

         <!-- JQUERY -->
    <script src="javascripts/jquery-3.2.1.min.js"></script>
    
  </head>
  <body id="shop_sales_report">
    

  <?php include '../includes/layouts/provider_header.php';?>


      <div class=" content container">
      
       <h1><?php echo $shop_name; ?> <small>Sales Report</small></h1>
       <blockquote class="text-center">Daily Sales</blockquote>

         <div class="row">
        <div class="col-sm-12">
        <div class="">
               <div id="chart" style="height: 250px;"></div>
          <!-- <div id="myfirstchart" style="height: 250px;"></div> -->
        </div>
     
        </div>
      </div>

        <div class="row">
         <form action="shop_sales_report.php?myshop=<?php echo $shop_id;?>" class="form-inline" method="POST">


         <div class="col-sm-9">

          <div class="form-group">
        
            
            <input type="date" name="date_start" class="form-control" style="margin: 10px;" value="<?php echo $date_start;?>"> 

            <label> <p>to</p> </label>

             <input type="date" name="date_end" class="form-control" style="margin: 10px;" value="<?php echo $date_end;?>">  
             
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
             
              <h4><strong>Clients: <?php echo $count; ?></strong></h4>
              <h4><strong>Total Sales: P <?php if(!empty($total_sales)){echo $total_sales;} else { echo '0.00';} ?></strong></h4>
              <div class="table-responsive">
              <table class="table">

                <tr>
                    
                    <th width="20%"> User</th>
                  <th width="20%">Schedule Date</th>
                  <th width="20%">Payment Date</th>
                  <th width="20%">Payment Type</th>
                  <th width="20%">Amount Paid</th>
                  
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                          <td><?php echo $row['user_uid']; ?></td>
                      <td><?php echo $row['schedule_date']; ?></td>
                      <td><?php echo $row['payment_date']; ?></td>
                      <td><?php echo $row['method']; ?></td>
                      <td>P <?php echo $row['amount_paid']; ?></td>
              
                 
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

          ykeys: ['count','daily_sales'],

          labels: ['Clients','Daily sales'],

          resize: true,

          redraw: true
          

         });
      }
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