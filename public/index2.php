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
    $shop_category = 0;
  

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

   // Retrieve services
    $results = mysqli_query($connection, "SELECT * FROM services WHERE shop_id = ".$_GET['myshop']." AND service_status = 1");


  // Marker results
    $marker_results = mysqli_query($connection, "SELECT * FROM markers WHERE shop_id = $shop_id");

    $resultCheck = mysqli_num_rows($marker_results);


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

    <script src="javascripts/jquery-3.2.1.min.js"></script>
  </head>
  <body id="home2">
    
  <?php include '../includes/layouts/provider_header.php';?>

   

      <div class="content container-fluid bg" style="padding-top: 150px; padding-bottom: 150px;" >
    
 

         <div class="center">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2"><h1 style="color:white;"><strong>Fixpertr a web and mobile application for repair and alteration services</strong>  </h1></div>
            </div>
          
             
          </div>

     

      </div>
      <br>
      <div class="container">
        <div class="row">
          <h2 class="text-center"><strong>Features</strong></h2>


        <div class="row">
       
        
          <div class="col-md-4" style="">
            <table>
              <tr>
                <td style="padding: 15px;">
                  <span class="glyphicon glyphicon-search features" style=" color:skyblue;"></span>  
                </td>
                <td colspan="2">
                  <h3>Search repair and alteration shops</h3>
                </td>
              </tr>
            </table>
          
         
          </div>

          <div class="col-md-4">
          <table>
              <tr>
                <td style="padding: 15px;">
                  <span class="glyphicon glyphicon-calendar features"></span>  
                </td>
                <td colspan="2">
                  <h3>Set schedules to repair and alteration shops</h3>
                </td>
              </tr>
            </table>
          
          </div>

          <div class="col-md-4">
                <table>
              <tr>
                <td style="padding: 15px;">
                  <span class="glyphicon glyphicon-map-marker features" style="color:
 #ff1a1a" ></span>  
                </td>
                <td colspan="2">
                  <h3>You can see the shop locations</h3>
                </td>
              </tr>
            </table>
          
          </div>
          <div class="col-md-4">
                <table>
              <tr>
                <td style="padding: 15px;">
                  <span class="glyphicon glyphicon-cog features" style="color: #8c8c8c"></span>  
                </td>
                <td colspan="2">
                  <h3>Manage your own shop as service provider</h3>
                </td>
              </tr>
            </table>
          
          </div>

            <div class="col-md-4">
                <table>
              <tr>
                <td style="padding: 15px;">
                  
                    <img src="images/Paypal-icon.png" id="paypal"> 
                </td>
                <td colspan="2">
                    <h3>You can pay online</h3> 
                </td>
              </tr>

            </table>
          
          </div>

        </div>
        </div>
      </div>

                           <!-- Modal -->
                    <div id="deleted" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Message</h4>
                          </div>
                          <div class="modal-body">
                          <ul class="list-inline">
                          
                            <li> <h5 class="alert alert-success">Your account is successfully deleted.</h5> </li>
                          </ul>
                           
                           
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                          </div>
                        </div>

                      </div>
                    </div>

                        <script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"user_fetch.php",
   method:"POST",
   data:{view:view,user_id:<?php echo $_SESSION['u_id'];?>},
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
 

 
 $(document).on('click', '#notify-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>






    <?php include '../includes/layouts/footer.php';?>