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

  //Retrieve markers
  $results = mysqli_query($connection, "SELECT * FROM markers WHERE shop_id = $shop_id") or die(mysqli_error($connection));
  $resultCheck = mysqli_num_rows($results);
  echo $resultCheck
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Fixpertr</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/mystyles.css">



    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

    


  </head>
  <body id="shop_locations">
    

  <?php include '../includes/layouts/provider_header.php';?>


      <div class="content container">
       
        <div class="row">



         
          
            <div class="col-sm-12">
                     <h1>Add <span class="glyphicon glyphicon-plus" ></span> Locations </h1>
                    <?php   $resultCheck = mysqli_num_rows($results);
                        if ($resultCheck < 1): ?>
                    <script type="text/javascript">

                     $(function() { $("#nolocations").modal('show'); });

                    </script>


              <?php endif ?> 
            


         <ul class="bg-info">
         <li ><p >To add <span class="glyphicon glyphicon-plus"></span> location just click the place where the shop is located.<p></li>
         <li>Fill the form and then click <strong>Save.</strong> <span class="glyphicon glyphicon-floppy-saved"></span></li>
       </ul>
            </div>
        
 
      </div>
  
      <div class="row">
        <div class="col-sm-12">

   <div id="map" height="460px" width="100%"></div>
   <br/>
    <div id="form">
      <table >
       <tr><td><input type='hidden' id='shop' value="<?php echo $shop_id;?>" /> </td> </tr>
      <tr><td>Name:</td> <td><input type='text' id='name'/> </td> </tr>
      <tr><td>Address:</td> <td><input type='text' id='address'/> </td> </tr>
       <tr><td></td><td><input type='button' value='Save' onclick='saveData()'/></td></tr>
      </table>
    </div>
    <br/>
    <div id="message">Location saved</div>
    <script>
      var map;
      var marker;
      var infowindow;
      var messagewindow;

      function initMap() {
        var california = {lat: -33.863276, lng: 151.207977 };
        map = new google.maps.Map(document.getElementById('map'), {
          center: california,
          zoom: 13
        });

        infowindow = new google.maps.InfoWindow({
          content: document.getElementById('form')
        });

        messagewindow = new google.maps.InfoWindow({
          content: document.getElementById('message')
        });

        google.maps.event.addListener(map, 'click', function(event) {
          marker = new google.maps.Marker({
            position: event.latLng,
            map: map
          });


          google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
          });
        });
      }

      function saveData() {
        var shop = escape(document.getElementById('shop').value);
        var name = escape(document.getElementById('name').value);
        var address = escape(document.getElementById('address').value);
        var latlng = marker.getPosition();
        var url = 'phpsqlinfo_addrow.php?shop='+ shop +'&name=' + name + '&address=' + address + '&lat=' + latlng.lat() + '&lng=' + latlng.lng();

        downloadUrl(url, function(data, responseCode) {

          if (responseCode == 200 && data.length <= 1) {
            infowindow.close();
            messagewindow.open(map, marker);
          }
        });
      }

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request.responseText, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing () {
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



  

    <?php include '../includes/layouts/footer.php';?>