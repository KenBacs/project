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
  $marker_results = mysqli_query($connection, "SELECT * FROM markers WHERE shop_id = $shop_id") or die(mysqli_error($connection));

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

    <!-- JQuery -->
    <script src="javascripts/jquery-3.2.1.min.js"></script>

  </head>
  <body id="remove_markers">
    

  <?php include '../includes/layouts/provider_header.php';?>

  
      <div class="content container">
           
       
        
      <div class="row">
        <div class="col-sm-12">
         <h1>Update and Delete Locations </h1>
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
   <div id="map" height="460px" width="100%"></div>
   <br/>
    <div id="form">
      <table >
       <tr><td><input type='hidden' id='shop' value="<?php echo $shop_id;?>" /> </td> </tr>
      <tr><td>Name:</td> <td><input type='text' id='name'/> </td> </tr>
      <tr><td>Address:</td> <td><input type='text' id='address'/> </td> </tr>
       <tr><td></td><td><input type='button' value='Update' onclick='saveData()'/><input type='button' value='Delete' onclick='saveData()'/></td>

       </tr>
      </table>
    </div>
    <br/>
    <div id="message">Location updated</div>
    <script>
      var map;
      var marker;
      var infowindow;
      var messagewindow;

      function initMap() {
        var cebu = {lat:10.315308, lng:123.885462};
        map = new google.maps.Map(document.getElementById('map'), {
          center: cebu,
          zoom: 8

        });

          <?php
              $datas = array();
             if (mysqli_num_rows($marker_results) > 0) {
              while ($row = mysqli_fetch_assoc($marker_results)) {
                $datas[] = $row;
                
              }
           }

        foreach ($datas as $key ) { ?>

          addMarker({id:<?php echo $key['id']?>,coords:{lat:<?php echo $key['lat'];?>,lng:<?php echo $key['lng'];?>},
            name:'<?php echo $key['name'];?>',address: '<?php echo $key['address'];?>'});
          
        <?php }?>


        infowindow = new google.maps.InfoWindow({
          content: document.getElementById('form')
        });

        messagewindow = new google.maps.InfoWindow({
          content: document.getElementById('message')
        });

     /*   google.maps.event.addListener(map, 'click', function(event) {
          marker = new google.maps.Marker({
            position: event.latLng,
            map: map
          });

        });*/

           // Add Marker Function
      function addMarker(props){
          document.getElementById('shop').value = props.id;
           document.getElementById('name').value = props.name;
          document.getElementById('address').value = props.address;
        

        var marker = new google.maps.Marker({
          position:props.coords,
          map:map,
        });

         var infowindow = new google.maps.InfoWindow({
          content: document.getElementById('form')
            
        });


    /*  var infowindow = new google.maps.InfoWindow({
          content: props.content
        });

         marker.addListener('click', function() {
          infowindow.open(map, marker);
        });*/

          google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
          });

        }

        
      }

   /*   function saveData() {
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
      }*/

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