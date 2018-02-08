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
    mysqli_query($connection,"DELETE FROM services WHERE service_id = $service_id") or die(mysqli_error($connection)); 
   
     $msg ="service deleted successfully";
      $msgClass ="alert-success";
    
       
  }
   // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM services");
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
  <body id="services_admin">

  

  <?php include '../includes/layouts/admin_header.php';?>

    
    
    <div class="content container">
     <h2 class="text-center" style="margin-bottom: 20px;"><span class="glyphicon glyphicon-wrench"></span> Services</h2>
    <div class="row">

      <div class="col-md-4">
       

          <?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
          <?php endif;?>

         
       <form id="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
                  <input type="hidden" name="service_id" value="<?php echo $service_id;?>">
                          <div class="form-group">
                            <label for="user_id">Shop ID</label>
                            <input type="number"  class="form-control" name="shop_id" value="<?php echo $shop_id;?>">
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

                      </form>
      </div>  

      
        <div class="col-md-8">
            
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
                      <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-remove"></span> Delete</a>
                      </td>

                  </tr>

                                        <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete shop</h4>
                          </div>
                          <div class="modal-body">
                          <ul class="list-inline">
                            <li>
                               <h1><span class="glyphicon glyphicon-remove" style="color: red;"></span> </h1>
                            </li>
                            <li> <h5>Are you sure you want to delete this shop?</h5> </li>
                          </ul>
                           
                           
                          </div>
                          <div class="modal-footer">
                            <a href="services_admin.php?del=<?php echo $row['service_id']?>" class="btn btn-default" role="button"> Yes</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          </div>
                        </div>

                      </div>
                    </div>
                       
                  <?php } ?>
              </table>
            </div> 


              

        </div>
      </div>
                  

              
    </div> 



    <?php include '../includes/layouts/footer.php';?>