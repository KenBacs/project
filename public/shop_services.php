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
              <div align="right">
                <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add</button>
              </div>
              <br/> 
            <div id="service_table">
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

    <div id="add_data_Modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add service</h4>
          </div>
          <div class="modal-body">
            <form method="POST" id="insert_form">
              <input type="hidden" name="id" value="<?php echo $id;?>">
              <div class="form-group">
                <label for="service_name">Service Name:</label>
                <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Enter service" >
              </div>
              <div class="form-group">
                  <label for="service_desc">Description:</label>
                  <textarea class="form-control" rows="5" id="service_desc" name="service_desc" placeholder="Enter description"></textarea>
                </div>
              <div class="form-group">
                <label for="service_cost">Cost:</label>
                <div class="input-group">
                  <span class="input-group-addon">P</span>
                  <input type="text" class="form-control" id="service_cost" placeholder="Enter cost" name="service_cost">
                </div>
                
              </div>
              
              <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>  


   <script>  
     $(document).ready(function(){

          $('#insert_form').on('submit',function(event){
            event.preventDefault();
            if ($('#service_name').val() == "") {
              alert("Service name is required");
            }
            else if ($('textarea#service_desc').val() == "") {
              alert("Description is required");
            }
            else if ($('#service_cost').val() == "") {
              alert("Cost is required");
            }
            else
            {
                 $.ajax({  
                url:"insert.php",  
                method:"POST",  
                data:$('#insert_form').serialize(),  
                beforeSend:function(){  
                 $('#insert').val("Inserting");  
                },  
                success:function(data){  
                 $('#insert_form')[0].reset();  
                 $('#add_data_Modal').modal('hide');  
                 $('#service_table').html(data);  
                }  
               }); 
            }

          });

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
