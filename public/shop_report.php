<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  
    include_once '../includes/db_connection.php';

    $date_start = '';
    $date_end = '';
    $shop_type = '';

        // Retrive shop categories
        $category_results = mysqli_query($connection, "SELECT * FROM shop_categories") or die(mysqli_error($connection));
        
          // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM shops,shop_categories WHERE shops.shop_cat_id = shop_categories.shop_cat_id "); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM shops ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];


               // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_shops, date_created FROM shops GROUP BY date_created");
       

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["date_created"]."', shops:".$row["n_shops"]."}, ";
          }


     if (isset($_POST['submit'])) {

            $date_start = $_POST['date_start'];
            $date_end = $_POST['date_end'];
            $shop_type = $_POST['shop_type'];
       
           // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM shops,shop_categories WHERE shops.shop_cat_id = shop_categories.shop_cat_id "); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM shops ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];


               // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_shops, date_created FROM shops GROUP BY date_created");
       

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["date_created"]."', shops:".$row["n_shops"]."}, ";
          }


          if (!empty($shop_type)) {

            // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM shops,shop_categories WHERE shops.shop_cat_id = shop_categories.shop_cat_id  AND  shops.shop_cat_id = $shop_type "); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM shops WHERE shop_cat_id = $shop_type ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];


               // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_shops, date_created FROM shops WHERE shop_cat_id = $shop_type GROUP BY date_created");
       

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["date_created"]."', shops:".$row["n_shops"]."}, ";
          }

          
          }

         if (!empty($date_start) && !empty($date_end)) {

        // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM shops,shop_categories WHERE shops.shop_cat_id = shop_categories.shop_cat_id AND shops.date_created BETWEEN '$date_start' AND '$date_end' "); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM shops WHERE date_created BETWEEN '$date_start' AND '$date_end' ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];


               // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_shops, date_created FROM shops WHERE date_created BETWEEN '$date_start' AND '$date_end' GROUP BY date_created");
       

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["date_created"]."', shops:".$row["n_shops"]."}, ";
          }

        
         } 

         if (!empty($date_start) && !empty($date_end) && !empty($shop_type)) {
         

        // Retrieve records
        $results = mysqli_query($connection, "SELECT * FROM shops,shop_categories WHERE shops.shop_cat_id = shop_categories.shop_cat_id AND shops.shop_cat_id = $shop_type AND shops.date_created BETWEEN '$date_start' AND '$date_end' "); 

        $count_results = mysqli_query($connection,"SELECT COUNT(*) as count FROM shops WHERE shop_cat_id = $shop_type AND date_created BETWEEN '$date_start' AND '$date_end' ") or die(mysqli_error($connection));
  
         $record = mysqli_fetch_array($count_results);
         $count = $record['count'];


               // Retrieve for chart
          $chart_results = mysqli_query($connection, "SELECT COUNT(*) as n_shops, date_created FROM shops WHERE shop_cat_id = $shop_type AND date_created BETWEEN '$date_start' AND '$date_end' GROUP BY date_created");
       

          $chart_data = '';
          while ($row = mysqli_fetch_array($chart_results)) {


            $chart_data .= "{ date:'".$row["date_created"]."', shops:".$row["n_shops"]."}, ";
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
  </head>
  <body id="shop_report">
    

  <?php include '../includes/layouts/admin_header.php';?>


      <div class=" content container">
      
       <h1>Shop<small> Report</small></h1>
       <blockquote class="text-center">Shop Registered Chart</blockquote>

         <div class="row">
        <div class="col-sm-12">
        <div class="">
               <div id="chart" style="height: 250px;"></div>
        
        </div>
     
        </div>
      </div>

        <div class="row">
         <form action="shop_report.php" class="form-inline" method="POST">


         <div class="col-sm-9">

          <div class="form-group">
        
            
            <input type="date" name="date_start" class="form-control" style="margin: 10px;" value="<?php echo $date_start;?>"> 

            <label> <p>to</p> </label>

             <input type="date" name="date_end" class="form-control" style="margin: 10px;" value="<?php echo $date_end;?>">  
             
              <select name="shop_type" id="shop_type" class="form-control" style="margin:10px;">

                <option value="">Select Shop Type</option>

                <?php while ($row = mysqli_fetch_array($category_results)) { ?>

                   <option value="<?php echo $row['shop_cat_id'];?>"><?php echo $row['shop_category'];?></option>

                <?php } ?>
               

                </select>

               <script type="text/javascript">
                    document.getElementById('shop_type').value = "<?php echo $shop_type;?>";
                  </script>
                

               <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <button type="submit" name="reset" class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                  
          </div>   
         </div>
        

           </form>
            
        </div>

      

       <div class="row">  
         <div class="col-sm-12">
             
              <h4><strong>Shops: <?php echo $count; ?></strong></h4>
              <div class="table-responsive">
              <table class="table">

                <tr>
                    
                      <th width="10%"> User ID</th>
                    <th width="10%"> Shop ID</th>
                  <th width="10%">Shop Name</th>
                  <th width="10%">Shop Category</th>
                  <th width="10%">Date Created</th>
                  
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['user_id']; ?></td>
                      <td><?php echo $row['shop_id']; ?></td>
                      <td><?php echo $row['shop_name']; ?></td>
                      <td><?php echo $row['shop_category']; ?></td>
                      <td><?php echo $row['date_created']; ?></td>
        

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

          ykeys: ['shops'],

          labels: ['Shop Registered'],

          resize: true,

          redraw: true
          

         });
      }
      </script> 

  

    <?php include '../includes/layouts/footer.php';?>