<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  
    include_once '../includes/db_connection.php';
    
   
    $msg = '';
    $msgClass = '';
    $shop_id = 0;
    $service_id = 0;
    $service_name = '';
    $service_desc = '';
    $service_cost = 0;
    $edit_state = false;
    $keywords = ''; 

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

  if (isset($_POST['submit'])) {
    
     $service_id = mysql_prep($_POST['service_id']);
     $service_name = mysql_prep($_POST['service_name']);
     $service_desc = mysql_prep($_POST['service_desc']);
     $service_cost = mysql_prep($_POST['service_cost']);

     if (!empty( $shop_id ) && !empty($service_name) && !empty($service_desc) && !empty($service_cost) ) {
       if ($service_cost > 0) {

              $sql = "SELECT * FROM shops WHERE shop_id = $shop_id";
              $result = mysqli_query($connection, $sql);
              $resultCheck = mysqli_num_rows($result);
              if ($resultCheck) {
                $query = "INSERT INTO services (shop_id, service_name, service_description, service_cost) VALUES ('$shop_id', '$service_name', '$service_desc', $service_cost)";

               if (mysqli_query($connection, $query)) {
                 $msg ="service added successfully";
                 $msgClass ="alert-success";


                    $service_id = 0;
                    $service_name = '';
                    $service_desc = '';
                    $service_cost = 0;

               
               } else {
                  $msg ="Failed to add service";
                  $msgClass ="alert-danger";
               }

              } else {
                 $msg ="Invalid shop";
                  $msgClass ="alert-danger";
              }

          

       } else {
          $msg ="Invalid cost";
         $msgClass ="alert-danger";
       }
     } else {
         $msg ="Fill all fields";
         $msgClass ="alert-danger";
     }
  
  }

    if (isset($_POST['update'])) {
    
     $service_id = mysql_prep($_POST['service_id']);
     $service_name = mysql_prep($_POST['service_name']);
     $service_desc = mysql_prep($_POST['service_desc']);
     $service_cost = mysql_prep($_POST['service_cost']);

     if (!empty( $shop_id ) && !empty($service_name) && !empty($service_desc) && !empty($service_cost) ) {
       if ($service_cost > 0) {

              $sql = "SELECT * FROM shops WHERE shop_id = $shop_id";
              $result = mysqli_query($connection, $sql);
              $resultCheck = mysqli_num_rows($result);
              if ($resultCheck) {
                $query = "UPDATE services SET shop_id = $shop_id, service_name = '$service_name', service_description = '$service_desc', service_cost = $service_cost WHERE service_id = $service_id";


               if (mysqli_query($connection, $query)) {
                 $msg ="service updated successfully";
                 $msgClass ="alert-success";

    
                  $service_id = 0;
                  $service_name = '';
                  $service_desc = '';
                  $service_cost = 0;
               } else {
                  $msg ="Failed to update service";
                  $msgClass ="alert-danger";
               }

              } else {
                 $msg ="Invalid shop";
                  $msgClass ="alert-danger";
              }

          

       } else {
          $msg ="Invalid cost";
         $msgClass ="alert-danger";
       }
     } else {
         $msg ="Fill all fields";
         $msgClass ="alert-danger";
     }
  
  }

    if (isset($_GET['edit'])) {
    $service_id = $_GET['edit'];
    $edit_state=true;
    $rec = mysqli_query($connection,"SELECT * FROM services WHERE service_id = $service_id");
    $record = mysqli_fetch_array($rec);
    $shop_id = $record['shop_id'];
    $service_id = $record['service_id'];
    $service_name = $record['service_name'];
    $service_desc = $record['service_description'];
    $service_cost = $record['service_cost'];
  }



  if (isset($_GET['del'])) {
    $service_id = mysql_prep($_GET['del']);
    $service_status = 0;
    mysqli_query($connection,"UPDATE services SET service_status = $service_status WHERE shop_id = $shop_id AND service_id = $service_id") or die(mysqli_error($connection)); 
   
     $msg ="service deleted successfully";
      $msgClass ="alert-success";
    
       
  }

  if (isset($_POST['clear'])) {
    $service_name = '';
    $service_desc = '';
    $service_cost = 0;
  }

    if (isset($_POST['reset'])) {
    $keywords = '';
  }

    //Retrieve for search service
    $service_results = mysqli_query($connection, "SELECT * FROM services WHERE shop_id = $shop_id AND service_status = 1");


   // Retrieve records
   $results = mysqli_query($connection, "SELECT * FROM services WHERE shop_id = $shop_id AND service_status = 1");

  if (isset($_POST['search'])) {
      $keywords = $_POST['keywords'];

      $results = mysqli_query($connection, "SELECT * FROM services WHERE shop_id = $shop_id AND service_status = 1") or die(mysqli_error($connection));

      if (!empty($keywords)) {
        $results = mysqli_query($connection, "SELECT * FROM services WHERE shop_id = $shop_id AND service_name LIKE '%{$keywords}%' AND service_status = 1 ") or die(mysqli_error($connection));
      }
  }


 



  
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
  <body id="shop_services">

  

  <?php include '../includes/layouts/provider_header.php';?>

    
    
    <div class="content container">
     <h1 class="text-center" style="margin-bottom: 20px;"><span class="glyphicon glyphicon-wrench"></span> <?php echo $shop_name;?> <small>Services</small> </h1>
    <div class="row">

      <div class="col-md-4">
       

          <?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
          <?php endif;?>

         
       <form id="" action="shop_services.php?myshop=<?php echo $shop_id;?>" method="POST" >
                  <input type="hidden" name="service_id" value="<?php echo $service_id;?>">
                       
                        <div class="form-group">
                            <label for="service_name">Service Name</label>
                            <input type="text" class="form-control" name="service_name" id="service_name" value="<?php echo $service_name;?>" autofocus>
                        </div> 

                         <div class="form-group">
                            <label for="service_desc">Service description</label>
                             <textarea class="form-control" rows="5" id="service_desc" name="service_desc" ><?php echo $service_desc;?></textarea>
                            
                        </div> 

                          <div class="form-group">
                            <label for="service_cost">Service Cost</label>
                            <div class="input-group">
                            
                              <span class="input-group-addon">P</span>

                            <input type="number" class="form-control" name="service_cost" value="<?php  echo $service_cost;?>">
                            </div>
                            
                        </div>

                        
                        
                          <?php if($edit_state == false): ?>
                            <button  type="submit" name="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-plus-sign"> </span> Create Service</button> 
                          <?php else: ?>
                            <button  type="submit" name="update" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-refresh"></span> Update Service</button> 
                          <?php endif ?>

                          <button  type="submit" name="clear" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-erase"></span> Clear Fields</button> 

                      </form>
      </div>  

      
        <div class="col-md-8">

        <div class="row">
          <div class="col-sm-12">
            <form action="shop_services.php?myshop=<?php echo $shop_id;?>" method="POST" class="form-inline  pull-right">
              <div class="form-group">
                <input type="text" name="keywords" class="form-control" placeholder="Search Service" style="margin:10px;" value="<?php echo $keywords;?>" autocomplete="off" list = "datalist1">
                <datalist id="datalist1">

                  <?php while ($row = mysqli_fetch_array($service_results)) { ?>
                        <option value="<?php echo $row['service_name'];?>">
                  <?php } ?>
 
              
                </datalist>

                 <button type="submit" class="btn btn-primary" name="search">Search</button>

                  <button type="submit" class="btn btn-primary" name="reset"><span class="glyphicon glyphicon-refresh"></span> Reset</button>

              </div>
            </form>
            
          </div>
        </div>
           <strong>Results: <?php $shop_count = mysqli_num_rows($results); echo $shop_count;?> </strong>    
          <div class="table-responsive"  >
              <?php if(!isset($_POST['search'])) :?>
                <?php   $resultCheck = mysqli_num_rows($results);
                          if ($resultCheck < 1): ?>
                      <script type="text/javascript">

                        $(function() { $("#noservice").modal('show'); });

                      </script>

                <?php endif ?> 
              <?php endif ?>        
              <table class="table">

                <tr>
                 

                <th width="10%">Shop ID</th>
                <th width="10%">Service ID</th>
                   <th width="10%">Service</th>
                  <th width="10%">Cost</th>
                  <th width="30%">Action</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['shop_id']; ?></td>
                      <td><?php echo $row['service_id']; ?></td>
                      <td><?php echo $row['service_name']; ?></td>
                      <td>P <?php echo $row['service_cost']; ?></td>
                      <td>
            
                      <a href="shop_services.php?myshop=<?php echo $shop_id;?>&edit=<?php echo $row['service_id']?>" class="btn btn-success" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                      <a href="shop_services.php?myshop=<?php echo $shop_id;?>&del=<?php echo $row['service_id']?>"  class="btn btn-danger" role="button" onclick="return confirm('Are you sure you want to delete this service?');" ><span class="glyphicon glyphicon-remove"></span> Delete</a>
                      </td>

                  </tr>

                       
                  <?php } ?>
              </table>
            </div> 


              

        </div>
      </div>
                  

              
    </div> 

        <script type="text/javascript">
      $(document).ready(function(){
          $("#OK").click(function(){
              $("#service_name").focus();
          });  
       
    });
    </script>

      <!-- Modal -->
  <div class="modal fade" id="noservice" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" ><span class="glyphicon glyphicon-floppy-remove"></span></span> Oops! You don't have any services yet!</span></h4>
        </div>
        <div class="modal-body">
       
            <div class="alert alert-info">
        <strong>Info!</strong> service is essential, so the customers can set schedule to your shop.
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="OK" class="btn btn-primary" data-dismiss="modal">OK</button>
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
