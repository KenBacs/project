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

      <!-- JQUERY -->
    <script src="javascripts/jquery-3.2.1.min.js"></script>
    
  </head>
  <body id="p_myshop">
    

     <?php include '../includes/layouts/provider_header.php';?>


      <div class=" content container">
        <div class="row">
          <div class="col-md-12">
            <h1><?php echo $shop_name; ?> <small><?php echo $shop_category; ?></small></h1>
          </div>
          
        </div>
        
        <div class="row" style="margin-top: 20px;">

          <div class="col-sm-4">
            
            <img src="images/<?php echo $shop_image;?>"  style="height: 300px; width: 300px;" class="img-responsive img-circle">
          </div>
          <div class="col-sm-8">
          
            <h3>Shop description</h3>
            <p><pre><?php echo $shop_description; ?></pre></p>

            <h3>Shop information</h3>
            <p><pre><span class="glyphicon glyphicon-phone-alt"></span> <?php echo $shop_contact; ?></pre></p>
            <p><pre>Business hours: <?php echo $day_start; ?> &mdash; <?php echo $day_end; ?>  <?php echo $time_start; ?> &mdash; <?php echo $time_end; ?></pre></p>

           

             <h3>Services Offered</h3>
            <div class="table-responsive" >
              <table class="table ">

                <tr>
                 
                  <th width="20%">Service</th>
                  <th width="20%">Description</th>
                  <th width="20%">Cost</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr class="success">
                     
                      <td > <?php echo $row['service_name']; ?></td>
                      <td > <?php echo $row['service_description'];?></td>
                      <td >P <?php echo $row['service_cost'];?></td>

                  </tr>

                       
                  <?php } ?>
              </table>
            </div> 


          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <h3><span class="glyphicon glyphicon-map-marker"></span>Shop Locations</h3>
            
                                 <ul class="bg-info">
         <li ><p style="padding: 20px"><span class="glyphicon glyphicon-eye-open"></span><strong> Click the shop marker to show  address. </strong></li>
        
       </ul>

       <?php if ($resultCheck < 1) { ?>
          <ul class="bg-danger">
         <li ><p style="padding: 20px"><span class="glyphicons glyphicons-database-ban"></span><strong> No Locations Found.</strong></li>
        
       </ul>
       <?php } ?>     

       <div id="map" style="margin-bottom: 20px;"></div>
        <script>

      function initMap() {
        var uluru = {lat:10.315308, lng:123.885462};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: uluru

        });
       

        <?php
              $datas = array();
             if (mysqli_num_rows($marker_results) > 0) {
              while ($row = mysqli_fetch_assoc($marker_results)) {
                $datas[] = $row;
                
              }
           }

        foreach ($datas as $key ) { ?>

          addMarker({coords:{lat:<?php echo $key['lat'];?>,lng:<?php echo $key['lng'];?>},
            content:'<h4><?php echo $key['name'];?></h4><h5><?php echo $key['address'];?></h5>'});
          
        <?php }?>



     // Add Marker Function
      function addMarker(props){

        var marker = new google.maps.Marker({
          position:props.coords,
          map:map,
        });

      var infowindow = new google.maps.InfoWindow({
          content: props.content
        });

         marker.addListener('click', function() {
          infowindow.open(map, marker);
        });

        }
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHqHUCFSjE6G0i9mX5hQTR1kJprdDSDnk&callback=initMap">
    </script>
   
          </div>
        </div>


    </div>

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
 
/* $('#comment_form').on('submit', function(event){
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
 });*/
 
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