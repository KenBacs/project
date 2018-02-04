<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  
    include_once '../includes/db_connection.php';
    
    $msg = '';
    $msgClass = '';
    $id = 0;
    $shop_id = 0;
    $service_id = 0;
    $service_name = '';
    $service_description = '';
    $service_cost = 0;
   

    if (isset($_GET['myshop'])) {
    $id = $_GET['myshop'];
   
    $rec = mysqli_query($connection,"SELECT * FROM shops WHERE shop_id = $id");
    $record = mysqli_fetch_array($rec);
    $shop_name = $record['shop_name'];
    $shop_image = $record['shop_image'];
    $shop_description = $record['shop_description'];
    $shop_contact = $record['shop_contact'];
    $shop_schedule = $record['shop_hours'];
    $shop_category = $record['shop_category'];



  }



  if (isset($_GET['edit'])) {
    $id =  $_GET['edit'];
    $edit_state=true;
    $rec = mysqli_query($connection,"SELECT * FROM services WHERE service_id = $id");
    $record = mysqli_fetch_array($rec);
    $id = $record['service_id'];
    $service_name = $record['service_name'];
    $service_description = $record['service_description'];
    $service_cost = $record['service_cost'];

  }



   // Retrieve records
  $result = mysqli_query($connection, "SELECT * FROM services WHERE shop_id = $id");

?>



<!doctype html>
<html lang="en">
  <head>
    <title>Fixpertr</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/mystyles.css">
  </head>
  <body id="shop_services">
    

  <?php include '../includes/layouts/provider_header.php';?>

  <div class="content container">
       <div class="row">
      <div class="col-md-6 col-md-offset-3">
         <div class="table-responsive">  
             <table class="table table-bordered">  
                  <tr>  
                       <th width="70%">Service Name</th>  
                       <th width="30%">View</th>  
                  </tr>  
                  <?php  
                  while($row = mysqli_fetch_array($result))  
                  {  
                  ?>  
                  <tr>  
                       <td><?php echo $row["service_name"]; ?></td>  
                       <td><input type="button" name="view" value="view" id="<?php echo $row["service_id"]; ?>" class="btn btn-info btn-xs view_data" /></td>  
                  </tr>  
                  <?php  
                  }  
                  ?>  
             </table>  
          </div> 

      </div>

    </div>


        <div id="dataModal" class="modal fade">  
        <div class="modal-dialog">  
             <div class="modal-content">  
                  <div class="modal-header">  
                       <button type="button" class="close" data-dismiss="modal">&times;</button>  
                       <h4 class="modal-title">Service Details</h4>  
                  </div>  
                  <div class="modal-body" id="service_detail">  
                  </div>  
                  <div class="modal-footer">  
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                  </div>  
             </div>  
        </div>  
    </div>  

  </div>

   <script>  
     $(document).ready(function(){  
          $('.view_data').click(function(){  
               var service_id = $(this).attr("id");  
               $.ajax({  
                    url:"select.php",  
                    method:"post",  
                    data:{service_id:service_id},  
                    success:function(data){  
                         $('#service_detail').html(data);  
                         $('#dataModal').modal("show");  
                    }  
               });  
          });  
     });  
     </script>
 
  

    <?php include '../includes/layouts/footer.php';?>
