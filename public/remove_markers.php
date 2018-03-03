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
    $results = mysqli_query($connection, "SELECT * FROM services WHERE shop_id = $shop_id AND service_status = 1");


  // Marker results
    $marker_results = mysqli_query($connection, "SELECT * FROM markers WHERE shop_id = $shop_id");



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


    <!-- JQuery -->
    <script src="javascripts/jquery-3.2.1.min.js"></script> 

        <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */

      #floating-panel {
        position: absolute;
        top: 10px;
        left: 35%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>

  </head>
  <body id="remove_markers">
    

     <?php include '../includes/layouts/provider_header.php';?>


      <div class=" content container">

      <div class="row">
        <div class="col-sm-12">
         <h1>Remove <span class="glyphicon glyphicon-remove" ></span> Locations </h1>
             <div>
                <?php   $resultCheck = mysqli_num_rows($marker_results);
                        if ($resultCheck < 1): ?>
                    <script type="text/javascript">

                     $(function() { $("#nolocations").modal('show'); });

                    </script>


              <?php endif ?> 
            
            </div>
            

        <table class="bg-danger" >
          <tr > 
              <th ><h2><span class="glyphicon glyphicon-warning-sign" style="margin-left: 20px;"></span></h2></th>
            
              <th width="100%"> <p style="margin: 20px;"><strong> Warning! This is a one time delete. If you click <kbd>Delete Markers</kbd> , all locations will be deleted.</strong> </p></th>
          </tr>
         
         </table>
          <br/>
          <div class="clearfix"></div>

         <ul class="bg-info">

         <li ><p >To remove <span class="glyphicon glyphicon-remove"></span>all locations just click <strong>Delete Markers.</strong></p></li>

          <li><p>To hide <span class="glyphicon glyphicon-eye-close"></span> all locations just click <strong>Hide Markers</strong></p></li>

          <li ><p >To show <span class="glyphicon glyphicon-eye-open"></span> all locations just click <strong>Show All Markers.</strong></p></li>

       
        
       </ul>
        </div>
      </div>
       <div class="row">
         <div class="col-sm-12">
           
    <div id="floating-panel">
      <input onclick="clearMarkers();" type=button value="Hide Markers">
      <input onclick="showMarkers();" type=button value="Show All Markers">
      <input onclick="deleteMarkers();" type=button value="Delete Markers">
    </div>
    <div id="map" style="margin-bottom: 20px;"></div>

    <script>

      // In the following example, markers appear when the user clicks on the map.
      // The markers are stored in an array.
      // The user can then click an option to hide, show or delete the markers.
      var map;
      var markers = [];

      function initMap() {
        var cebu = {lat:10.315308, lng:123.885462};

        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: cebu

         
        });

        // This event listener will call addMarker() when the map is clicked.
        map.addListener('click', function(event) {
          addMarker(event.latLng);
        });

        // Adds a marker at the center of the map.
        addMarker(haightAshbury);
      }

      // Adds a marker to the map and push to the array.
      function addMarker(location) {
        var marker = new google.maps.Marker({
          position: location,
          map: map
        });
        markers.push(marker);
      }

      // Sets the map on all markers in the array.
      function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

      // Removes the markers from the map, but keeps them in the array.
      function clearMarkers() {
        setMapOnAll(null);
      }

      // Shows any markers currently in the array.
      function showMarkers() {
        setMapOnAll(map);
      }

      // Deletes all markers in the array by removing references to them.
      function deleteMarkers() {
        clearMarkers();
        markers = [];
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHqHUCFSjE6G0i9mX5hQTR1kJprdDSDnk&callback=initMap">
    </script>
         </div>
       </div>

    </div>

     <!-- Modal -->
  <div class="modal fade" id="nolocations" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" ><span class="glyphicon glyphicon-floppy-remove"></span></span> Oops! You don't have any location yet!</span></h4>
        </div>
        <div class="modal-body">
       
            <div class="alert alert-info">
        <strong>Info!</strong> Location is essential, so the customers know where is your shop.
         </div>
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