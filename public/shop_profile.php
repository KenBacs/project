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

    if (isset($_GET['view'])) {
    $id = $_GET['view'];
    $rec = mysqli_query($connection,"SELECT * FROM shops,shop_categories WHERE shop_id = $id AND shops.shop_cat_id = shop_categories.shop_cat_id");
    $record = mysqli_fetch_array($rec);
    $id = $record['shop_id'];
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
    $service_results = mysqli_query($connection, "SELECT * FROM services WHERE shop_id = ".$_GET['view']."");
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
  </head>
  <body id="contact">
    

  <?php include '../includes/layouts/header.php';?>


      <div class=" content container">
           <div class="row">
          <div class="col-md-6">
            <h1><?php echo $shop_name; ?> <small><?php echo $shop_category; ?></small></h1>
          </div>
          <div class="col-md-6">
            <a href="set_schedule.php?set=<?php echo $id; ?>" class="btn btn-success btn-lg" style="margin-top: 20px;" role="button">Set Schedule Now!</a>
          </div>
        </div>
        
        <div class="row" style="margin-top: 20px;">

          <div class="col-sm-4">
            
            <img src="images/<?php echo $shop_image?>"  style="height: 300px; width: 300px;" class="img-responsive img-circle">
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
                 <?php while ($row = mysqli_fetch_array($service_results)) { ?>
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

              <div id="map" style="margin-bottom: 20px;"></div>

      <?php 
        $marker_results = mysqli_query($connection, "SELECT * FROM markers WHERE shop_id = $id");
      ?>

      <script type="text/xml">
          <markers>
          <marker id="1" name="Billy Kwong" address="1/28 Macleay Street, Elizabeth Bay, NSW" lat="-33.869843" lng="-151.225769" type="restaurant"/>
          <marker id="2" name="Love.Fish" address="580 Darling Street, Rozelle, NSW" lat="-33.861034" lng="151.171936" type="restaurant"/>
          <marker id="3" name="Young Henrys" address="76 Wilford Street, Newtown, NSW" lat="-33.898113" lng="151.174469" type="bar"/>
          <marker id="4" name="Hunter Gatherer" address="Greenwood Plaza, 36 Blue St, North Sydney NSW" lat="-33.840282" lng="151.207474" type="bar"/>
          <marker id="5" name="The Potting Shed" address="7A, 2 Huntley Street, Alexandria, NSW" lat="-33.910751" lng="151.194168" type="bar"/>
          <marker id="6" name="Nomad" address="16 Foster Street, Surry Hills, NSW" lat="-33.879917" lng="151.210449" type="bar"/>
          <marker id="7" name="Three Blue Ducks" address="43 Macpherson Street, Bronte, NSW" lat="-33.906357" lng="151.263763" type="restaurant"/>
          <marker id="8" name="Single Origin Roasters" address="60-64 Reservoir Street, Surry Hills, NSW" lat="-33.881123" lng="151.209656" type="restaurant"/>
          <marker id="9" name="Red Lantern" address="60 Riley Street, Darlinghurst, NSW" lat="-33.874737" lng="151.215530" type="restaurant"/>
          </markers>

      </script>
         <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-33.863276, 151.207977),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl(function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
    </script>
      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHqHUCFSjE6G0i9mX5hQTR1kJprdDSDnk&callback=initMap">
      </script>
            </div>
          </div>
          
  

      </div>
  

    <?php include '../includes/layouts/footer.php';?>