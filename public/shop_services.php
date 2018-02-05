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

          <br /><br />  
      <div class="container" style="width:700px;">  
       <h3 align="center">Insert Data Through Bootstrap Modal by using Ajax PHP</h3>  
       <br />  
       <div class="table-responsive">
        <div align="right">
         <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add</button>
        </div>
        <br />
        <div id="service_table">
         <table class="table table-bordered">
          <tr>
           <th width="70%">Service Name</th>  
            <th width="15%">Edit</th>  
            <th width="15%">View</th> 
          </tr>
          <?php
          while($row = mysqli_fetch_array($result))
          {
          ?>
          <tr>
           <td><?php echo $row["service_name"]; ?></td>
           <td><input type="button" name="edit" value="Edit" id="<?php echo $row["service_id"]; ?>" class="btn btn-info btn-xs edit_data" /></td>  
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

    <div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">PHP Ajax Insert Data in MySQL By Using Bootstrap Modal</h4>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <input type="hidden" name="service_id" id="service_id">
     <label>Enter Service Name</label>
     <input type="text" name="service_name" id="service_name" class="form-control" />
     <br />
     <label>Enter Description</label>
     <textarea name="service_desc" id="service_desc" rows="5" class="form-control"></textarea>
     <br />
     
     <label>Enter Cost</label>
     <div class="input-group">
       <span class="input-group-addon">P</span>
         <input type="text" name="service_cost" id="service_cost" class="form-control" />
     </div>
   
     <br />
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />

    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

<script>  
$(document).ready(function(){

    $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      }); 

  $(document).on('click', '.edit_data', function(){  
           var service_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch.php",  
                method:"POST",  
                data:{service_id:service_id},  
                dataType:"json",  
                success:function(data){  
                     $('#service_name').val(data.service_name);  
                     $('#service_desc').val(data.service_description);  
                     $('#service_cost').val(data.service_cost); 
                      $('#service_id').val(data.service_id);    
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  

 $('#insert_form').on("submit", function(event){  
  event.preventDefault();  
  if($('#service_name').val() == "")  
  {  
   alert("Service name is required");  
  }  
  else if($('#service_desc').val() == '')  
  {  
   alert("Service description is required");  
  }  
  else if($('#service_cost').val() == '')
  {  
   alert("Service cost is required");  
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




 $(document).on('click', '.view_data', function(){
  //$('#dataModal').modal();
  var service_id = $(this).attr("id");
  $.ajax({
   url:"select.php",
   method:"POST",
   data:{service_id:service_id},
   success:function(data){
    $('#service_detail').html(data);
    $('#dataModal').modal('show');
   }
  });
 });
});  
 </script>


    <?php include '../includes/layouts/footer.php';?>
