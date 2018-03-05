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
    $keywords  = '';

  if (isset($_POST['submit'])) {
    
    $shop_id = mysql_prep($_POST['shop_id']);
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

                    $shop_id = 0;
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
    
    $shop_id = mysql_prep($_POST['shop_id']);
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

                  $shop_id = 0;
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

     if (isset($_POST['clear'])) {
        $shop_id = 0;
        $service_id = 0;
        $service_name = '';
        $service_desc = '';
        $service_cost = 0;
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
    $service_id = $_GET['del'];
    $service_status = 0;

    mysqli_query($connection,"UPDATE services SET service_status = $service_status WHERE service_id = {$service_id}") or die(mysqli_error($connection)); 


   
     $msg ="service deleted successfully"; 
      $msgClass ="alert-success";

  
    
       
  }



   if (isset($_POST['reset'])) {
    $keywords = '';
  }
   // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM services WHERE service_status = 1");



    // Retrieve categories
  $category_results = mysqli_query($connection, "SELECT * FROM shop_categories");


    // Retrieve for services search
  $service_results = mysqli_query($connection, "SELECT * FROM services WHERE service_status = 1");

  if (isset($_POST['search'])) {
      $keywords = $_POST['keywords'];

       $results = mysqli_query($connection, "SELECT * FROM services WHERE service_status = 1");

      if (!empty($keywords)) {
        $results = mysqli_query($connection, "SELECT * FROM services WHERE (shop_id LIKE '%{$keywords}%' OR service_name LIKE '%{$keywords}%') AND service_status = 1 ") or die(mysqli_error($connection)) ;
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

        <!-- JQuery -->
    <script src="javascripts/jquery-3.2.1.min.js"></script>
  </head>
  <body id="services_admin">

  

  <?php include '../includes/layouts/admin_header.php';?>

    
    
    <div class="content container">
     <h2 class="text-center" style="margin-bottom: 20px;"><span class="glyphicon glyphicon-cog"></span> Services</h2>
    <div class="row">

      <div class="col-md-4">
       

          <?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
          <?php endif;?>

         
       <form id="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
                  
                          <div class="form-group">
                            <label for="user_id">Shop ID</label>
                            <input type="number"  class="form-control" name="shop_id" value="<?php echo $shop_id;?>" autofocus>
                        </div> 
                        <div class="form-group">
                            <label for="service_name">Service Name</label>
                            <input type="text" class="form-control" name="service_name" value="<?php echo $service_name;?>">
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

                          <input type="hidden" name="service_id" value="<?php echo $service_id;?>">


                            <button  type="submit" name="clear" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-erase"></span> </span> Clear fields</button>

                      </form>
      </div>  

      
        <div class="col-md-8">
             <div class="row">
          <div class="col-sm-12">
            <form action="services_admin.php" method="POST" class="form-inline  pull-right">
              <div class="form-group">
                <input type="text" name="keywords" class="form-control" placeholder="Search Service" style="margin:10px;" value="<?php echo $keywords;?>" autocomplete="off" list = "datalist1">
                <datalist id="datalist1">

                  <?php while ($row = mysqli_fetch_array($service_results)) { ?>
                        <option value="<?php echo $row['shop_id'];?>">
                        <option value="<?php echo $row['service_name'];?>">
                  <?php } ?>
 
              
                </datalist>

                 <button type="submit" class="btn btn-primary" name="search">Search</button>

                  <button type="submit" class="btn btn-primary" name="reset"><span class="glyphicon glyphicon-refresh"></span> Reset</button>

              </div>
            </form>
            
          </div>
        </div>
            <strong>Service id value:<?php echo $service_id; ?> </strong>
            <br>
          <strong>Results: <?php $shop_count = mysqli_num_rows($results); echo $shop_count;?> </strong>
          <div class="table-responsive"  >
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
            
                      <a href="services_admin.php?edit=<?php echo $row['service_id']?>" class="btn btn-success" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                      
                       <a href="services_admin.php?del=<?php echo $row['service_id']?>" class="btn btn-danger" role="button" onclick="return confirm('Are you sure you want to delete this service?');"><span class="glyphicon glyphicon-remove"></span> Delete</a>
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
     
     function load_unseen_notification(view3 = '')
     {
      $.ajax({
       url:"admin_fetch_subscriptions.php",
       method:"POST",
       data:{view3:view3},
       dataType:"json",
       success:function(data)
       {
        $('#notify-admin').html(data.notification);
        if(data.unseen_notification > 0)
        {
         $('.count').html(data.unseen_notification);
        }
       }
      });
     }
     
     load_unseen_notification();
     

     
     $(document).on('click', '#notify-toggle-admin', function(){
      $('.count').html('');
      load_unseen_notification('yes');
     });
     
     setInterval(function(){ 
      load_unseen_notification();; 
     }, 5000);
     
    });


        </script>




    <?php include '../includes/layouts/footer.php';?>