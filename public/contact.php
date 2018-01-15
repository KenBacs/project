<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>

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
        <h2 class="text-center" style="margin-bottom: 30px;">Contact Us</h2>
        <div class="col-sm-8">
           
        <div id="map"></div>
        <script>
          function initMap() {
            var uluru = {lat: 10.323207, lng: 123.890173};
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 15,
              center: uluru
            });
            var marker = new google.maps.Marker({
              position: uluru,
              map: map
            });
          }
        </script>

        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHqHUCFSjE6G0i9mX5hQTR1kJprdDSDnk&callback=initMap">
        </script>
        </div>

        <div class="col-sm-4">
         <span class="glyphicon glyphicon-home"></span> <p>1726 Villalon Drive Ponce Capitol Site, Cebu City, Philippines, 6000</p>
         <span class="glyphicon glyphicon-phone-alt"></span><p>(032)236-4363</p>
         <span class="glyphicon glyphicon-envelope"></span> <p>kennethbacayo@gmail.com (for inquiries)</p>
        </div>
       
      </div>
  

    <?php include '../includes/layouts/footer.php';?>